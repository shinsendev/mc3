<?php

declare(strict_types=1);

namespace App\Tests\Functional;

class CategoryResourceGetCollectionTest extends AbstractFunctionalTest
{
    /**
     * @throws \Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\DecodingExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface
     */
    public function testGetCategories()
    {
        $response = $this->client->request('GET', 'api/categories', [
            'headers' => [
                'Content-Type' => 'application/json',
            ],
        ]);

        $this->assertResponseIsSuccessful();
        $this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');
        $arrayResponse = $response->toArray();
        $this->assertEquals(4, count($arrayResponse['hydra:member']), 'Uncorrect numbers of catgeories');
        $this->assertEquals('censorship', $arrayResponse['hydra:member'][2]['title']);
        $this->assertEquals('number', $arrayResponse['hydra:member'][1]['model']);
        $this->assertEquals('6d9ade45-877a-4b99-bb1b-408d9e3087f4', $arrayResponse['hydra:member'][0]['uuid']);
        $this->assertEquals('Ethnic stereotypes', $arrayResponse['hydra:member'][0]['title']);
    }
}