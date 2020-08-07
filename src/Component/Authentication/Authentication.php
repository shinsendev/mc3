<?php

namespace App\Component\Authentication;

use Kreait\Firebase\Auth;
use Kreait\Firebase\Factory;

class Authentication
{
    /**
     * @return Auth
     */
    public static function createFirebaseAuth():Auth
    {
        $factory = (new Factory())->withServiceAccount('../keys/firebase_credentials.json');

        return $factory->createAuth();
    }

    /**
     * @param Auth $auth
     * @param string $email
     * @param string $password
     * @return mixed
     */
    public static function checkPassword(Auth $auth, string $email, string $password)
    {
        return ($auth->signInWithEmailAndPassword($email, $password))->data();
    }

    public static function checkToken(Auth $auth, string $token)
    {

    }

    public static function checkRefreshToken(Auth $auth, string $refreshToken)
    {

    }
}