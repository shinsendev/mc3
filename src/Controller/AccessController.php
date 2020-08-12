<?php

namespace App\Controller;

use ApiPlatform\Core\Api\IriConverterInterface;
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
        if (!$this->isGranted('ACTIVATED_USER', $this->getUser())) {
            return $this->json([
                'error' => 'Invalid login request: content type must be application/json and user must be activated',
            ], 403);
        }

        return new JsonResponse([
            'Location' => $iriConverter->getIriFromItem($this->getUser())
        ]);
    }

}
