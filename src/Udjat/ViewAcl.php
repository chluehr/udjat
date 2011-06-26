<?php

namespace Udjat;

/**
 * 
 */
class ViewAcl extends View
{

    public $hasSearch = true;

    public $isLoggedIn = true;

    public $email = '';

    public function __construct()
    {

        $this->email = @$_SESSION['email'];

        $this->clusters = array(
            array(
                'label' => 'Public Cluster A',
                'key' => '/pub-clust-a',
            ),
            array(
                'label' => 'Private Cluster B',
                'key' => '/priv-clust-b',
            ),
        );

    }

}
