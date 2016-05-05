<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit22336145355a80a946db7540e7011aca
{
    public static $prefixLengthsPsr4 = array (
        'M' => 
        array (
            'MAD\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'MAD\\' => 
        array (
            0 => __DIR__ . '/../..' . '/app',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit22336145355a80a946db7540e7011aca::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit22336145355a80a946db7540e7011aca::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
