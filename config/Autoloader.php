<?php

namespace config;

/**
 * Autoloader class used to autoload classes for the whole program
 */
class Autoloader
{
    /**
     * Method used to do the actual autoloading
     */
    static function register(): void
    {
        spl_autoload_register(array(__CLASS__, 'autoload'));
    }

    /**
     * Method used to define the path followed to autoload classes
     *
     * @param $className
     */
    static function autoload($className): void
    {
        $className = str_replace("\\", "/", $className);
        require $className . '.php';
    }
}
