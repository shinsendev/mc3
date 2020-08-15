<?php

namespace App\Component\DataPersister;

use ApiPlatform\Core\DataPersister\ContextAwareDataPersisterInterface;
use App\Component\Error\Mc3Error;
use App\Entity\Indexation;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Process\Process;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class IndexationDataPersister implements ContextAwareDataPersisterInterface
{
    private HttpClientInterface $client;
    private EntityManagerInterface $em;

    public function __construct(HttpClientInterface $client, EntityManagerInterface $em)
    {
        $this->client = $client;
        $this->em = $em;
    }

    /**
     * @param $data
     * @param array $context
     * @return bool
     */
    public function supports($data, array $context = []): bool
    {
        return $data instanceof Indexation;
    }

    /**
     * @param $data
     * @param array $context
     * @return object|void
     * @throws \Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface
     */
    public function persist($data, array $context = [])
    {
        // check if last indexation is finished
        // todo = add a command that set the indexation in progress to false at the end
        if ($lastIndexation = $this->em->getRepository(Indexation::class)->getLastIndexation()) {
            if ($lastIndexation->getInProgress()) {
                throw new Mc3Error('Indexation avoided and not created. Another process is already running.', 400);
            }
        }

        // get data and save the import
        $this->em->persist($data);
        $this->em->flush();

        $this->launchIndexation($data);
    }

    public function remove($data, array $context = [])
    {
        // no delete function
    }

    /**
     * @param Indexation $data
     * @return bool
     */
    private function launchIndexation(Indexation $data):bool
    {
        $process = Process::fromShellCommandline('cd ../ && php bin/console indexation:start');
        $process->start();
        sleep(3); // fot letting the time to launch the commands
        return true;
    }

}