<?php

namespace Udjat;

/**
 * 
 */
class Dispatcher
{

    /**
     * @param string $str
     * @return string
     */
    protected function _sanitize($str)
    {
        $str = preg_replace(
            '/[^a-z]/','', strtolower($str)
        );

        if ($str === '') {
            $str = 'index';
        }

        return $str;
    }

    /**
     * @return void
     */
    public function dispatch()
    {
        $requestUri = $_SERVER["REQUEST_URI"];

        // using error suppression via @ is bad style:

        @list(
            $dummy,
            $controllerName,
            $actionName,
            $params
                ) = explode('/', $requestUri);

        $controllerName = $this->_sanitize($controllerName);
        $actionName     = $this->_sanitize($actionName);

        $controllerClassName = 'Udjat\\Ctrl\\'.ucfirst($controllerName);

        $controllerClass =  new $controllerClassName();

        $actionMethodName = $actionName . 'Action';

        $controllerClass->$actionMethodName();
    }
}
