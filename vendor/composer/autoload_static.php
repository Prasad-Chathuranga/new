<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitda5f2cdd90678cecb7d2e599bbb90a89
{
    public static $prefixLengthsPsr4 = array (
        'F' => 
        array (
            'Flasher\\SweetAlert\\Prime\\' => 25,
            'Flasher\\Prime\\' => 14,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Flasher\\SweetAlert\\Prime\\' => 
        array (
            0 => __DIR__ . '/..' . '/php-flasher/flasher-sweetalert',
        ),
        'Flasher\\Prime\\' => 
        array (
            0 => __DIR__ . '/..' . '/php-flasher/flasher',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitda5f2cdd90678cecb7d2e599bbb90a89::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitda5f2cdd90678cecb7d2e599bbb90a89::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitda5f2cdd90678cecb7d2e599bbb90a89::$classMap;

        }, null, ClassLoader::class);
    }
}
