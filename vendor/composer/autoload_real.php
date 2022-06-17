<?php

// autoload_real.php @generated by Composer

class ComposerAutoloaderInite6f743ca3d7dbac91ed562b14bf925cc
{
    private static $loader;

    public static function loadClassLoader($class)
    {
        if ('Composer\Autoload\ClassLoader' === $class) {
            require __DIR__ . '/ClassLoader.php';
        }
    }

    /**
     * @return \Composer\Autoload\ClassLoader
     */
    public static function getLoader()
    {
        if (null !== self::$loader) {
            return self::$loader;
        }

        require __DIR__ . '/platform_check.php';

        spl_autoload_register(array('ComposerAutoloaderInite6f743ca3d7dbac91ed562b14bf925cc', 'loadClassLoader'), true, true);
        self::$loader = $loader = new \Composer\Autoload\ClassLoader(\dirname(__DIR__));
        spl_autoload_unregister(array('ComposerAutoloaderInite6f743ca3d7dbac91ed562b14bf925cc', 'loadClassLoader'));

        require __DIR__ . '/autoload_static.php';
        call_user_func(\Composer\Autoload\ComposerStaticInite6f743ca3d7dbac91ed562b14bf925cc::getInitializer($loader));

        $loader->register(true);

        return $loader;
    }
}