<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit03c2fab1aa26ff57403a74f41d25cc72
{
    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'PHPMailer\\PHPMailer\\' => 20,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'PHPMailer\\PHPMailer\\' => 
        array (
            0 => __DIR__ . '/..' . '/phpmailer/phpmailer/src',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit03c2fab1aa26ff57403a74f41d25cc72::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit03c2fab1aa26ff57403a74f41d25cc72::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
