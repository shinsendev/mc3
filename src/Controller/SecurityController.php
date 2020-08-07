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
        dd('ici');
        $factory = (new Factory)->withServiceAccount('../keys/firebase.json');
        $auth = $factory->createAuth();

        $uid = 'some-uid';

        $customToken = $auth->createCustomToken($uid);

        $userProperties = [
            'email' => 'user@example.com',
            'emailVerified' => false,
            'phoneNumber' => '+15555550100',
            'password' => 'secretPassword',
            'displayName' => 'John Doe',
            'photoUrl' => 'http://www.example.com/12345678/photo.png',
            'disabled' => false,
        ];

        $createdUser = $auth->createUser($userProperties);
        dd($createdUser);

        return $this->json([
                'user' => $this->getUser() ? $this->getUser()->getId() : null]
        );
    }
}
