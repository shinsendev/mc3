<?php

declare(strict_types=1);


namespace App\Controller;


use App\Component\DTO\Payload\HomePayloadDTO;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class HomeController
{
    /**
     * @Route("/", name="getHome")
     */
    public function getHomepage()
    {
        $home = new HomePayloadDTO();
        $home->setStats('123 films, 1200 numbers');

        return new JsonResponse($home);
    }
}