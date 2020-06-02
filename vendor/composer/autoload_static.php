<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit69538fb6bbe96e5a01044f04ae6c9ab8
{
    public static $prefixLengthsPsr4 = array (
        'u' => 
        array (
            'updater\\' => 8,
        ),
        'I' => 
        array (
            'Inc2734\\WP_GitHub_Plugin_Updater\\' => 33,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'updater\\' => 
        array (
            0 => __DIR__ . '/../..' . '/',
        ),
        'Inc2734\\WP_GitHub_Plugin_Updater\\' => 
        array (
            0 => __DIR__ . '/..' . '/inc2734/wp-github-plugin-updater/src',
        ),
    );

    public static $prefixesPsr0 = array (
        'P' => 
        array (
            'Parsedown' => 
            array (
                0 => __DIR__ . '/..' . '/erusev/parsedown',
            ),
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit69538fb6bbe96e5a01044f04ae6c9ab8::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit69538fb6bbe96e5a01044f04ae6c9ab8::$prefixDirsPsr4;
            $loader->prefixesPsr0 = ComposerStaticInit69538fb6bbe96e5a01044f04ae6c9ab8::$prefixesPsr0;

        }, null, ClassLoader::class);
    }
}
