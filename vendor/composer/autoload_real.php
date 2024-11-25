<?php

// autoload_real.php @generated by Composer

class ComposerAutoloaderInitcf4b418c9dcbc064e1df03748fb4efbf
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

        spl_autoload_register(array('ComposerAutoloaderInitcf4b418c9dcbc064e1df03748fb4efbf', 'loadClassLoader'), true, true);
        self::$loader = $loader = new \Composer\Autoload\ClassLoader(\dirname(__DIR__));
        spl_autoload_unregister(array('ComposerAutoloaderInitcf4b418c9dcbc064e1df03748fb4efbf', 'loadClassLoader'));

        require __DIR__ . '/autoload_static.php';
        call_user_func(\Composer\Autoload\ComposerStaticInitcf4b418c9dcbc064e1df03748fb4efbf::getInitializer($loader));

        $loader->register(true);

        return $loader;
    }
}
