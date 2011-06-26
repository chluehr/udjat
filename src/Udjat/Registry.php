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
}
