<?php

// autoload_real.php @generated by Composer

<<<<<<< HEAD
class ComposerAutoloaderInit1ec242f4108cab164426c90c31e60d15
=======
class ComposerAutoloaderInita782c08424f3ac4a24dc71d851a0b0b0
>>>>>>> master
{
    private static $loader;

    public static function loadClassLoader($class)
    {
        if ('Composer\Autoload\ClassLoader' === $class) {
            require __DIR__ . '/ClassLoader.php';
        }
    }

<<<<<<< HEAD
    /**
     * @return \Composer\Autoload\ClassLoader
     */
=======
>>>>>>> master
    public static function getLoader()
    {
        if (null !== self::$loader) {
            return self::$loader;
        }

<<<<<<< HEAD
        spl_autoload_register(array('ComposerAutoloaderInit1ec242f4108cab164426c90c31e60d15', 'loadClassLoader'), true, true);
        self::$loader = $loader = new \Composer\Autoload\ClassLoader();
        spl_autoload_unregister(array('ComposerAutoloaderInit1ec242f4108cab164426c90c31e60d15', 'loadClassLoader'));
=======
        spl_autoload_register(array('ComposerAutoloaderInita782c08424f3ac4a24dc71d851a0b0b0', 'loadClassLoader'), true, true);
        self::$loader = $loader = new \Composer\Autoload\ClassLoader();
        spl_autoload_unregister(array('ComposerAutoloaderInita782c08424f3ac4a24dc71d851a0b0b0', 'loadClassLoader'));
>>>>>>> master

        $useStaticLoader = PHP_VERSION_ID >= 50600 && !defined('HHVM_VERSION') && (!function_exists('zend_loader_file_encoded') || !zend_loader_file_encoded());
        if ($useStaticLoader) {
            require_once __DIR__ . '/autoload_static.php';

<<<<<<< HEAD
            call_user_func(\Composer\Autoload\ComposerStaticInit1ec242f4108cab164426c90c31e60d15::getInitializer($loader));
=======
            call_user_func(\Composer\Autoload\ComposerStaticInita782c08424f3ac4a24dc71d851a0b0b0::getInitializer($loader));
>>>>>>> master
        } else {
            $map = require __DIR__ . '/autoload_namespaces.php';
            foreach ($map as $namespace => $path) {
                $loader->set($namespace, $path);
            }

            $map = require __DIR__ . '/autoload_psr4.php';
            foreach ($map as $namespace => $path) {
                $loader->setPsr4($namespace, $path);
            }

            $classMap = require __DIR__ . '/autoload_classmap.php';
            if ($classMap) {
                $loader->addClassMap($classMap);
            }
        }

        $loader->register(true);

        if ($useStaticLoader) {
<<<<<<< HEAD
            $includeFiles = Composer\Autoload\ComposerStaticInit1ec242f4108cab164426c90c31e60d15::$files;
=======
            $includeFiles = Composer\Autoload\ComposerStaticInita782c08424f3ac4a24dc71d851a0b0b0::$files;
>>>>>>> master
        } else {
            $includeFiles = require __DIR__ . '/autoload_files.php';
        }
        foreach ($includeFiles as $fileIdentifier => $file) {
<<<<<<< HEAD
            composerRequire1ec242f4108cab164426c90c31e60d15($fileIdentifier, $file);
=======
            composerRequirea782c08424f3ac4a24dc71d851a0b0b0($fileIdentifier, $file);
>>>>>>> master
        }

        return $loader;
    }
}

<<<<<<< HEAD
function composerRequire1ec242f4108cab164426c90c31e60d15($fileIdentifier, $file)
=======
function composerRequirea782c08424f3ac4a24dc71d851a0b0b0($fileIdentifier, $file)
>>>>>>> master
{
    if (empty($GLOBALS['__composer_autoload_files'][$fileIdentifier])) {
        require $file;

        $GLOBALS['__composer_autoload_files'][$fileIdentifier] = true;
    }
}
