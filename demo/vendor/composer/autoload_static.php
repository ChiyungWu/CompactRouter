<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitf81850b848171e438a91e0f47a1336d5
{
    public static $prefixLengthsPsr4 = array (
        'A' => 
        array (
            'App\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'App\\' => 
        array (
            0 => __DIR__ . '/../..' . '/app',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitf81850b848171e438a91e0f47a1336d5::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitf81850b848171e438a91e0f47a1336d5::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitf81850b848171e438a91e0f47a1336d5::$classMap;

        }, null, ClassLoader::class);
    }
}