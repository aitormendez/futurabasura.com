<?php

// autoload_real.php @generated by Composer

class ComposerAutoloaderInitcc5a6f938ac670951ff5aa218b9826b1
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

        spl_autoload_register(array('ComposerAutoloaderInitcc5a6f938ac670951ff5aa218b9826b1', 'loadClassLoader'), true, true);
        self::$loader = $loader = new \Composer\Autoload\ClassLoader(\dirname(__DIR__));
        spl_autoload_unregister(array('ComposerAutoloaderInitcc5a6f938ac670951ff5aa218b9826b1', 'loadClassLoader'));

        require __DIR__ . '/autoload_static.php';
        \Composer\Autoload\ComposerStaticInitcc5a6f938ac670951ff5aa218b9826b1::getInitializer($loader)();

        $loader->register(true);

        return $loader;
    }
}
