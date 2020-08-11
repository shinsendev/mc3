<?php

namespace App\Component\Authentication;

use App\Component\Error\Mc3Error;
use Kreait\Firebase\Auth;
use Kreait\Firebase\Auth\SignIn\FailedToSignIn;
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
        // if ... = ok return true
        // todo : add the logic

        return false;
    }

    /**
     * @param Auth $auth
     * @param string $refreshToken
     * @return Auth\SignInResult
     */
    public static function checkRefreshToken(Auth $auth, string $refreshToken):Auth\SignInResult
    {
        try {
            return $auth->signInWithRefreshToken($refreshToken);
        }
        catch (FailedToSignIn $e) {
            throw new Mc3Error('Error during authentication: '. $e->getMessage(), 403);
        }
    }
}