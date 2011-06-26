<?php

namespace Udjat\Ctrl;

/**
 * 
 */
class Dashboard extends \Udjat\CtrlAclAbstract
{

    /**
     * @return void
     */
    public function indexAction()
    {
        $this->viewAction();
    }

    /**
     * @return void
     */
    public function viewAction()
    {


        $view = new \Udjat\ViewAcl();

        $view->menu = array(
            array(
                'label' => 'Dashboard',
                'url' => '/dashboard',
                'selected' => true
            ),
            array(
                'label' => 'Charts',
                'url' => '/charts',
            ),
        );


        $view->sidebar = '<h3>Sample Sidebar</h3>';

        $view->render('header.php');
        $view->render('dashboard/index.php');
        $view->render('footer.php');
    }
}
