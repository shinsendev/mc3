<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class FilmController extends AbstractController
{
    /**
     * @Route("/film/{filmId}", name="getFilm")
     */
    public function getOneFilm($filmId)
    {
        return new JsonResponse('Exemple de film');
    }

}
