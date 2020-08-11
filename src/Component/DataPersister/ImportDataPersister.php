<?php

namespace App\Component\DataPersister;

use ApiPlatform\Core\DataPersister\ContextAwareDataPersisterInterface;
use App\Entity\Import;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class ImportDataPersister implements ContextAwareDataPersisterInterface
{
    private HttpClientInterface $client;
    private EntityManagerInterface $em;

    public function __construct(HttpClientInterface $client, EntityManagerInterface $em)
    {
        $this->client = $client;
        $this->em = $em;
    }

    public function supports($data, array $context = []): bool
    {
        return $data instanceof Import;
    }

    public function persist($data, array $context = [])
    {
        // get data and save the import
        $this->em->persist($data);
        $this->em->flush();

        // launch the import by
        $result = $this->client->request('POST', $_ENV['IMPORTER_API_URL'], [
            //todo : add the key
        ]);

        dd($result);
        dd('last here after transformation and security for saving');
        //todo : launch import here
    }

    public function remove($data, array $context = [])
    {
        // no delete function
    }

}