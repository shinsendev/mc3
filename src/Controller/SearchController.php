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
        // todo: create a post route, get request from parameters
        $client = ElasticConnection::connect();

        $params = [
            'index' => 'mc2',
            'body'  => [
                'query' => [
                    'match' => [
                        'title' => 'West'
                    ]
                ]
            ]
        ];


        $results = $client->search($params);

        return new JsonResponse($results);
    }
}
