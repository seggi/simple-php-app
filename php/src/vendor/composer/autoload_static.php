<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit728260656daca05c14ee755291e063d2
{
    public static $prefixLengthsPsr4 = array (
        'A' => 
        array (
            'Api\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Api\\' => 
        array (
            0 => __DIR__ . '/../..' . '/Api',
        ),
    );

    public static $classMap = array (
        'Api\\Config\\Database' => __DIR__ . '/../..' . '/Api/Config/Database.php',
        'Api\\Objects\\Product' => __DIR__ . '/../..' . '/Api/Objects/Product.php',
        'Api\\Product\\ReadData' => __DIR__ . '/../..' . '/Api/Product/ReadData.php',
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit728260656daca05c14ee755291e063d2::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit728260656daca05c14ee755291e063d2::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit728260656daca05c14ee755291e063d2::$classMap;

        }, null, ClassLoader::class);
    }
}
