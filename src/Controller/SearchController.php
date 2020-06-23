<?php

namespace App\Controller;

use App\Component\Elastic\ElasticConnection;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class SearchController extends AbstractController
{
    /**
     * @Route("/search", name="search")
     */
    public function getResults(string $type = null)
    {
        $params = [
            'index' => 'mc2',
            'id'    => 'e51d1683-0252-474e-9647-8dba4598fff8'
        ];
        

        $client = ElasticConnection::connect();
        $response = $client->get($params);

        return new JsonResponse($response);
    }
}
