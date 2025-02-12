<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit5fa47e8f91385b62a9bad012923e267d
{
    public static $prefixLengthsPsr4 = array (
        'T' => 
        array (
            'Testpackage\\TestV1\\' => 19,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Testpackage\\TestV1\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit5fa47e8f91385b62a9bad012923e267d::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit5fa47e8f91385b62a9bad012923e267d::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit5fa47e8f91385b62a9bad012923e267d::$classMap;

        }, null, ClassLoader::class);
    }
}
