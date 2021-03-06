<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitb865e2245aa6f05ba5cfb0d5ad685efd
{
    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'Psr\\Log\\' => 8,
        ),
        'M' => 
        array (
            'Monolog\\' => 8,
        ),
        'A' => 
        array (
            'App\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Psr\\Log\\' => 
        array (
            0 => __DIR__ . '/..' . '/psr/log/Psr/Log',
        ),
        'Monolog\\' => 
        array (
            0 => __DIR__ . '/..' . '/monolog/monolog/src/Monolog',
        ),
        'App\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static $prefixesPsr0 = array (
        'S' => 
        array (
            'Slim' => 
            array (
                0 => __DIR__ . '/..' . '/slim/slim',
            ),
        ),
        'F' => 
        array (
            'Flynsarmy\\SlimMonolog' => 
            array (
                0 => __DIR__ . '/..' . '/flynsarmy/slim-monolog',
            ),
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitb865e2245aa6f05ba5cfb0d5ad685efd::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitb865e2245aa6f05ba5cfb0d5ad685efd::$prefixDirsPsr4;
            $loader->prefixesPsr0 = ComposerStaticInitb865e2245aa6f05ba5cfb0d5ad685efd::$prefixesPsr0;
            $loader->classMap = ComposerStaticInitb865e2245aa6f05ba5cfb0d5ad685efd::$classMap;

        }, null, ClassLoader::class);
    }
}
