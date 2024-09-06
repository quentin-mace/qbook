<?php

namespace config;

/**
 * Autoloader class used to autoload classes for the whole program
 */
class Autoloader
{
    /**
     * Method used to do the actual autoloading
     *
     * @return void
     */
    static function register()
    {
        spl_autoload_register(array(__CLASS__, 'autoload'));
    }

    /**
     * Method used to define the path followed to autoload classes
     *
     * @param $className
     * @return void
     */
    static function autoload($className)
    {
        $className = str_replace("\\", "/", $className);
        require $className . '.php';
    }
}
