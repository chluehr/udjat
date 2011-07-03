<?php

namespace Udjat\Ctrl;

/**
 * 
 */
class Rpx extends \Udjat\CtrlAbstract
{
    const RPX_API_KEY = 'a296fef33d223ec68236aa00eb53e87bcf8bf123';

    /**
     * @return void
     */
    public function indexAction()
    {
    }

    /**
     * @return void
     */
    public function tokenAction()
    {

        //For a production script it would be better to include the apiKey in from a file outside the web root to enhance security.
        $rpx_api_key = self::RPX_API_KEY;

        /* STEP 1: Extract token POST parameter */
        $token = $_POST['token'];


        if (strlen($token) != 40) {

            die('Illegal token (1040).');
        }

        /* STEP 2: Use the token to make the auth_info API call */
        $post_data = array(
            'token'  => $token,
            'apiKey' => $rpx_api_key,
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



                echo "\n auth_info:";
                echo "\n"; var_dump($auth_info);


                // profile][providerName => "Google"
                // profile]["identifier": "https:\/\/www.google.com\/profiles\/116563369376278600467",
                //profile]["email": "xris@farcaster.net"
                
                /* STEP 4: Use the identifier as the unique key to sign the user into your system.
                   This will depend on your website implementation, and you should add your own
                   code here. The user profile is in $auth_info.
                */

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
