<?php

namespace Udjat;

/**
 * 
 */
abstract class CtrlAclAbstract extends CtrlAbstract
{

    /**
     * 
     */
    public function __construct()
    {

        if (!isset($_SESSION['user'])) {

            $this->_redirect('/');
        }
    }

}
