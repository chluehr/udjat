<?php

namespace Udjat;

/**
 * 
 */
class Bootstrap
{

    /**
     * Quicker autoload implementation
     * @static
     * @param string $className
     * @return void
     */
    public static function autoLoad($className)
    {

        // convert namespace to full file path
        $classFile = ROOT_PATH . DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR
            .  str_replace('\\', DIRECTORY_SEPARATOR, $className) . '.php';
        if (!file_exists($classFile)) {
            return;
        }

        require_once $classFile;
    }

    /**
     * @static
     * @return void
     */
    static function init()
    {

        session_start();
        
        define(
            'ROOT_PATH',
            realpath(
                dirname(__FILE__) . DIRECTORY_SEPARATOR . '..'
                . DIRECTORY_SEPARATOR . '..'
            )
        );

        set_include_path(
            ROOT_PATH . DIRECTORY_SEPARATOR . 'src'
        );

		// setup autoloader:

        spl_autoload_register('Udjat\Bootstrap::autoLoad');

        // $username = '';
        // $password = '';
        $database = 'udjat';
        $host     = 'localhost';

        // $dsn = "mongodb://${username}:${password}@${host}/${database}";

        $mongo = new \Mongo(); // @todo use config, use dsn for mongo connect
        $mongoDb = $mongo->selectDB($database);
        Registry::getInstance()->setMongoDb($mongoDb);

        $config = new Config();
        $config->load(ROOT_PATH.'/etc/config.php');

        Registry::getInstance()->setConfig($config);
    }
}
