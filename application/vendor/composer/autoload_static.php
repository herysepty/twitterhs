<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit32077277cb7cd4452066a9a61df64632
{
    public static $prefixLengthsPsr4 = array (
        'A' => 
        array (
            'Abraham\\TwitterOAuth\\' => 21,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Abraham\\TwitterOAuth\\' => 
        array (
            0 => __DIR__ . '/..' . '/abraham/twitteroauth/src',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit32077277cb7cd4452066a9a61df64632::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit32077277cb7cd4452066a9a61df64632::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
