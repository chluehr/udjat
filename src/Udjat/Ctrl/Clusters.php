<?php

namespace Udjat\Ctrl;

/**
 * 
 */
class Clusters extends \Udjat\CtrlAclAbstract
{

    /**
     * @return void
     */
    public function indexAction()
    {

        $view = new \Udjat\ViewAcl();

        $view->contextMenu = array(
            array(
                'label' => 'Add cluster',
                'url' => '/clusters/add',
            ),
        );

        $view->render('header.php');
        $view->render('clusters/index.php');
        $view->render('footer.php');
    }

    /**
     * @return void
     */
    public function addAction()
    {

        if (@$_POST['cancel'] != '') {

            $this->_redirect('/clusters');
        }

        $view = new \Udjat\ViewAcl();

        $view->render('header.php');
        $view->render('clusters/add.php');
        $view->render('footer.php');
    }
}
