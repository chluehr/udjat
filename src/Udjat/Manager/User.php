<?php

namespace Udjat\Manager;

/**
 * 
 */
class User
{

    const COLLECTION_USER = 'user';
    const PASSWORD_SALT = 'GUI5(6$F';

    /**
     * @param string $email
     * @param string $password
     * 
     * @return bool
     */
    public function register($email, $password)
    {

        try {
            
            $mongoDb = \Udjat\Registry::getInstance()->getMongoDb();
            $users = $mongoDb->selectCollection(self::COLLECTION_USER);

            $user = new \Udjat\Document\User();
            $user->email = $email;
            $user->passwordHash = md5(self::PASSWORD_SALT . $password);
            $users->insert((array)$user, array('safe'=>true));

        } catch (MongoCursorException $exception) {

            return false;
        }

        return true;
    }

    /**
     * @param string $email
     * @param string $password
     *
     * @return bool
     */
    public function isValidUser($email, $password)
    {
        $mongoDb = \Udjat\Registry::getInstance()->getMongoDb();
        $users = $mongoDb->selectCollection(self::COLLECTION_USER);

        $userFound = (
            $users->find(
                array(
                     'email'        => $email,
                     'passwordHash' => md5(self::PASSWORD_SALT . $password)
                )
            )->count() == 1
        );

        return $userFound;
    }

    /**
     * @param string $email
     * @param string $password
     *
     * @return bool
     */
    public function getIdByEmail($email)
    {
        $mongoDb = \Udjat\Registry::getInstance()->getMongoDb();
        $users = $mongoDb->selectCollection(self::COLLECTION_USER);

        $user = $users->find(
                array(
                     'email'        => $email,
                )
            )->limit(1);

        $id = null;

        if ($user->hasNext()) {
            $user->next();
            $id = $user->key();
        }
        return $id;
    }

    /**
     * @param string $userId
     *
     * @return array
     */
    public function listClusters($userId)
    {


    }

}
