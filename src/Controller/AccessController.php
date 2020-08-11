<?php

namespace App\Controller;

use ApiPlatform\Core\Api\IriConverterInterface;
use App\Component\Authentication\Authentication;
use App\Component\Error\Mc3Error;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Kreait\Firebase\Factory;

class AccessController extends AbstractController
{
    /**
     * @Route("/login", name="app_login", methods={"POST"})
     */
    public function login(IriConverterInterface $iriConverter)
    {
        if (!$this->isGranted('ACTIVATED_USER', $this->getUser())) {
            return $this->json([
                'error' => 'Invalid login request: content type must be application/json and user must be activated',
            ], 403);
        }

        return new JsonResponse([
            'Location' => $iriConverter->getIriFromItem($this->getUser())
        ]);
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
