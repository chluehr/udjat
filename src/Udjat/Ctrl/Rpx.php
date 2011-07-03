<?php

namespace Udjat\Ctrl;

/**
 * 
 */
class Rpx extends \Udjat\CtrlAbstract
{
    /**
     * @return void
     */
    public function indexAction()
    {
        die (\Udjat\Registry::getInstance()->getConfig()->rpxApiKey);
    }

    /**
     * @return void
     */
    public function tokenAction()
    {

        $rpxApiKey = \Udjat\Registry::getInstance()->getConfig()->rpxApiKey;

        /* STEP 1: Extract token POST parameter */
        $token = $_POST['token'];

        if (strlen($token) != 40) {

            die('Illegal token (1040).');
        }

        /* STEP 2: Use the token to make the auth_info API call */
        $post_data = array(
            'token'  => $token,
            'apiKey' => $rpxApiKey,
            'format' => 'json',
            'extended' => 'false'  //Extended is not available to Basic.
        );

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_URL, 'https://rpxnow.com/api/v2/auth_info');
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $post_data);
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_FAILONERROR, true);
        $result = curl_exec($curl);
        if ($result == false) {
        echo "\n".'Curl error: ' . curl_error($curl);
        echo "\n".'HTTP code: ' . curl_errno($curl);
        echo "\n"; var_dump($post_data);
            die('CURL Error.');
        }
        curl_close($curl);


        /* STEP 3: Parse the JSON auth_info response */
        $auth_info = json_decode($result, true);

        if (is_array($auth_info) && array_key_exists('stat', $auth_info)) {

            if ($auth_info['stat'] == 'ok') {

                $userManager = new \Udjat\Manager\User();

                $id = $userManager->getIdByIdentity($auth_info['profile']['identifier']);
                        
                if ($id === null) {
                    // new user, register!
                    $userManager->registerBySocial(
                        $auth_info['profile']['providerName'],
                        $auth_info['profile']['identifier'],
                        $auth_info['profile']['email']
                    );

                    $id = $userManager->getIdByIdentity($auth_info['profile']['identifier']);

                }
                // existing user, login!

                $_SESSION['email'] = $auth_info['profile']['email'];
                $_SESSION['user'] = $id;
                $this->_redirect('/dashboard');

            } else {
                // Gracefully handle auth_info error.  Hook this into your native error handling system.
                echo "\n".'An error occured: ' . $auth_info['err']['msg']."\n";
                var_dump($auth_info);
                echo "\n";
                var_dump($result);
            }

        } else {
          // Gracefully handle the missing or malformed token.  Hook this into your native error handling system.
          die('Authentication canceled.');
        }

    }
}
