<?php declare(strict_types=1);

namespace Monopage\Packages;

use Monopage\Contracts\Exceptions\MaintenanceException;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class Loader
{
    protected ContainerBuilder $container;
    protected array $classes = [];

    public function __construct(ContainerBuilder $container)
    {
        $this->container = $container;
    }

    /**
     * @param array $classes
     *
     * @throws MaintenanceException
     */
    public function registerPackages(array $classes): void
    {
        foreach ($classes as $class) {
            $this->registerPackage($class);
        }
    }

    /**
     * @param string $class
     *
     * @throws MaintenanceException
     */
    public function registerPackage(string $class): void
    {
        if (!is_subclass_of($class, PackageInterface::class)) {
            throw new MaintenanceException(sprintf(
                'Class "%s" must implement "%s"',
                $class,
                PackageInterface::class
            ));
        }

        if (!isset($this->classes[$class])) {
            $this->classes[$class] = false;
        }
    }

    public function load(): void
    {
        foreach ($this->classes as $class => $loaded) {
            if ($loaded) {
                continue;
            }
            $this->classes[$class] = true;
            /** @var PackageInterface $package */
            $package = new $class($this->container);
            $package->bootstrap();
        }
    }
}
