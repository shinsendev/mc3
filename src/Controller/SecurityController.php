<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Kreait\Firebase\Factory;
use Kreait\Firebase\Auth;

class SecurityController extends AbstractController
{
    /**
     * @Route("/login", name="app_login", methods={"POST"})
     */
    public function login()
    {
        $factory = (new Factory)->withServiceAccount('../keys/firebase.json');
        $auth = $factory->createAuth();

        $uid = 'some-uid';

        $customToken = $auth->createCustomToken($uid);
        dd($customToken);

        return $this->json([
                'user' => $this->getUser() ? $this->getUser()->getId() : null]
        );
    }
}
