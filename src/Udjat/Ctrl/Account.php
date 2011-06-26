<?php

namespace Udjat\Ctrl;

/**
 * 
 */
class Account extends \Udjat\CtrlAbstract
{

    /**
     * @return void
     */
    public function indexAction()
    {
        $this->_redirect('/');
    }

    /**
     * @return void
     */
    public function logoutAction()
    {
        unset($_SESSION['user']);
        session_destroy();
        $this->_redirect('/');
    }

    /**
     * @return void
     */
    public function loginAction()
    {

        $view = new \Udjat\View();

        // process?
        if (trim(@$_POST['email']) != '') {

            $userManager = new \Udjat\Manager\User();

            if ($userManager->isValidUser($_POST['email'], $_POST['password'])) {

                $id = $userManager->getIdByEmail($_POST['email']);
                $_SESSION['email'] = $_POST['email'];
                $_SESSION['user'] = $id;
                $this->_redirect('/dashboard');

            } else {

                $view->flashError = 'Wrong credentials.';
            }
        }

        $view->render('header.php');
        $view->render('account/login.php');
        $view->render('footer.php');

    }

    /**
     * @return void
     */
    public function registerAction()
    {

        $view = new \Udjat\View();

        // process?
        if (trim(@$_POST['email']) != '') {

            if (@$_POST['password'] != @$_POST['password_repeat']) {

                $view->flashError = 'Password repetition does not match.';
                
            } else {

                $userManager = new \Udjat\Manager\User();
                if ($userManager->register($_POST['email'], $_POST['password'])) {
                    $this->_redirect('/account/register');
                } else {
                    $view->flashError = 'Register failed.';
                }
            }
        }


        $view->render('header.php');
        $view->render('account/register.php');
        $view->render('footer.php');
    }

}
