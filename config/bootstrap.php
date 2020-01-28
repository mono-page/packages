<?php declare(strict_types=1);

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\PhpFileLoader;

return static function (ContainerBuilder $container) {
    (new PhpFileLoader(
        $container,
        new FileLocator(dirname(__DIR__))
    ))->load(__DIR__ . '/dependencies.php');

    // ...
};
