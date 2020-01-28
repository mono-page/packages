<?php declare(strict_types=1);

namespace Monopage\Packages;

use Symfony\Component\DependencyInjection\ContainerBuilder;

class Package implements PackageInterface
{
    protected ContainerBuilder $container;

    public function __construct(ContainerBuilder $container)
    {
        $this->container = $container;
    }

    public function bootstrap(): void
    {
        $bootstrap = require __DIR__ . '/../config/bootstrap.php';

        $bootstrap($this->container);
    }
}
