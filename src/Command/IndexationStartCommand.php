<?php

namespace App\Command;

use App\Component\Importer\AllIndexationSteps;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class IndexationStartCommand extends Command
{
    protected static $defaultName = 'indexation:start';

    private EntityManagerInterface $em;
    private LoggerInterface $logger;
    private HttpClientInterface $client;

    /**
     * IndexationStartCommand constructor.
     * @param EntityManagerInterface $em
     * @param LoggerInterface $logger
     * @param HttpClientInterface $client
     * @param string|null $name
     */
    public function __construct(EntityManagerInterface $em, LoggerInterface $logger, HttpClientInterface $client, string $name = null)
    {
        parent::__construct($name);
        $this->em = $em;
        $this->logger = $logger;
        $this->client = $client;
    }

    protected function configure()
    {
        $this
            ->setDescription('Start indexation : compute stats, reindex on ES and Algolia, and update Indexation entity')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        AllIndexationSteps::execute($this->em, $this->logger, $output, $this->client);
        $io->success('Indexation has been successfully completed.');

        return 0;
    }
}
