<?php

namespace App\Controller;

use App\Component\Authentication\Authentication;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Kreait\Firebase\Factory;

class SecurityController extends AbstractController
{
    /**
     * @Route("/login", name="app_login", methods={"POST"})
     */
    public function login(Request $request)
    {
        $auth = Authentication::createFirebaseAuth();

        $content = json_decode($request->getContent());
        $email = $content->email;
        $password = $content->password;

        //return a token front can keep
        return $this->json(Authentication::checkPassword($auth, $email, $password), 200);
    }

    private function checkPassword($auth, string $email, string $password)
    {
        return ($auth->signInWithEmailAndPassword($email, $password))->data();
    }

    /**
     * @Route("/refresh_token", name="checkToken", methods={"POST"})
     */
    public function refreshToken(Request $request)
    {
        $auth = Authentication::createFirebaseAuth();
        $refreshToken = "";

        $signInResult = $auth->signInWithRefreshToken($refreshToken);
        dd($signInResult);
    }

    public function checkToken(Request $request)
    {

    }

    private function createFirebaseAuth()
    {
        $factory = (new Factory)->withServiceAccount('../keys/firebase_credentials.json');
        return $factory->createAuth();
    }

}
