<?php

namespace App\Controller;

use App\Component\Elastic\ElasticConnection;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class SearchController
 * @package App\Controller
 */
class SearchController extends AbstractController
{
    /**
     * @Route("/search", methods={"POST"})
     */
    public function search(Request $request)
    {
        $client = ElasticConnection::connect();
        $results = $client->search(json_decode($request->getContent(), true));

        return new JsonResponse($results);
    }
}
