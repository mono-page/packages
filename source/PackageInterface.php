<?php declare(strict_types=1);

namespace Monopage\Packages;

use Symfony\Component\DependencyInjection\ContainerBuilder;

interface PackageInterface
{
    public function __construct(ContainerBuilder $container);

    public function bootstrap(): void;
}
