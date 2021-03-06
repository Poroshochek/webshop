<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit6f3fe7a802cf13c8bc83be04b0f7fe85
{
    public static $prefixLengthsPsr4 = array (
        'w' => 
        array (
            'webshop\\' => 8,
        ),
        'a' => 
        array (
            'app\\' => 4,
        ),
        'V' => 
        array (
            'Valitron\\' => 9,
        ),
        'R' => 
        array (
            'RedBeanPHP\\' => 11,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'webshop\\' => 
        array (
            0 => __DIR__ . '/..' . '/webshop/core',
        ),
        'app\\' => 
        array (
            0 => __DIR__ . '/../..' . '/app',
        ),
        'Valitron\\' => 
        array (
            0 => __DIR__ . '/..' . '/vlucas/valitron/src/Valitron',
        ),
        'RedBeanPHP\\' => 
        array (
            0 => __DIR__ . '/..' . '/gabordemooij/redbean/RedBeanPHP',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit6f3fe7a802cf13c8bc83be04b0f7fe85::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit6f3fe7a802cf13c8bc83be04b0f7fe85::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
