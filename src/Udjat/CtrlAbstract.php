<?php

namespace Udjat;

/**
 * 
 */
class CtrlAbstract
{

    /**
     * @param  $path
     * @return void
     */
    protected function _redirect($path)
    {
        header('Location: '.$path);
        exit;
    }
}
