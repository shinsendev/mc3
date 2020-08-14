<?php

namespace App\Controller;

use ApiPlatform\Core\Api\IriConverterInterface;
use App\Component\Error\Mc3Error;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class AccessController extends AbstractController
{
    /**
     * @Route("/login", name="app_login", methods={"POST"})
     */
    public function login(IriConverterInterface $iriConverter)
    {
        if (!$this->getUser()) {
            throw new Mc3Error('No corresponding user found in Mc3, hint : you might use json to authenticate.');
        }

        if (!$this->isGranted('ACTIVATED_USER', $this->getUser())) {
            throw new Mc3Error('Error with login permission :', 403);
        }

        return new JsonResponse([
            'Location' => $iriConverter->getIriFromItem($this->getUser())
        ]);
    }

    /**
     * @Route("/logout", name="app_logout")
     */
    public function logout()
    {
        throw new \Exception('Not supposed to be reached, Loggout is supposed to be managed by Symfony');
    }

}
