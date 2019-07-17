<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit0ebf3547ffdee09d4120754e56e8d4c5
{
    public static $prefixLengthsPsr4 = array (
        'G' => 
        array (
            'GK\\' => 3,
        ),
        'A' => 
        array (
            'App\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'GK\\' => 
        array (
            0 => __DIR__ . '/..' . '/GK',
        ),
        'App\\' => 
        array (
            0 => __DIR__ . '/../..' . '/App',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit0ebf3547ffdee09d4120754e56e8d4c5::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit0ebf3547ffdee09d4120754e56e8d4c5::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
