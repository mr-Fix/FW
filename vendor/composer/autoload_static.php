<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit625eb05cffce033dcc2b9286f3077a81
{
    public static $prefixLengthsPsr4 = array (
        'f' => 
        array (
            'fw\\' => 3,
        ),
        'a' => 
        array (
            'app\\' => 4,
        ),
        'V' => 
        array (
            'Valitron\\' => 9,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'fw\\' => 
        array (
            0 => __DIR__ . '/..' . '/fw',
        ),
        'app\\' => 
        array (
            0 => __DIR__ . '/../..' . '/app',
        ),
        'Valitron\\' => 
        array (
            0 => __DIR__ . '/..' . '/vlucas/valitron/src/Valitron',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit625eb05cffce033dcc2b9286f3077a81::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit625eb05cffce033dcc2b9286f3077a81::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}