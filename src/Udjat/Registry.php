<?php

namespace Udjat;

/**
 * 
 */
class Registry
{
    /**
     * @var \MongoDB
     */
    protected $_mongoDb;

    /**
     * @var Config
     */
    protected $_config;


    /**
     * @var Registry
     */
    protected static $_instance = null;

    /**
     * @return Registry
     */
    public static function getInstance()
    {

        if (self::$_instance === null) {
            self::$_instance = new Registry();
        }
        return self::$_instance;
    }

    /**
     * @return \MongoDB
     */
    public function getMongoDb()
    {
        return $this->_mongoDb;
    }

    /**
     * @param \MongoDB $mongoDb
     * @return void
     */
    public function setMongoDb(\MongoDB $mongoDb)
    {
        $this->_mongoDb = $mongoDb;
    }

    /**
     * @return Config
     */
    public function getConfig()
    {
        return $this->_config;
    }

    /**
     * @param Config $config
     * @return void
     */
    public function setConfig(Config $config)
    {
        $this->_config = $config;
    }

}
