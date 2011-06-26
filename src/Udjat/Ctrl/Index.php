<?php

namespace Udjat\Ctrl;

/**
 * 
 */
class Index extends \Udjat\CtrlAbstract
{

    /**
     * @return void
     */
    public function indexAction()
    {

        if (trim(@$_SESSION['user']) != '') {
            $this->_redirect('/clusters');
        }

        $view = new \Udjat\View();
        $view->render('header.php');
        $view->render('account/login.php');
        $view->render('footer.php');
    }
}
