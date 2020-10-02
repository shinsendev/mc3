<?php

namespace App\Command;

use App\Component\Importer\AllIndexationSteps;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class IndexationStartCommand extends Command
{
    protected static $defaultName = 'indexation:start';

    private EntityManagerInterface $em;
    private LoggerInterface $logger;
    private HttpClientInterface $client;
    private Filesystem $filesystem;
    private KernelInterface $kernel;
    private SerializerInterface $serializer;

    /**
     * IndexationStartCommand constructor.
     * @param EntityManagerInterface $em
     * @param LoggerInterface $logger
     * @param HttpClientInterface $client
     * @param Filesystem $filesystem
     * @param KernelInterface $kernel
     * @param SerializerInterface $serializer
     * @param string|null $name
     */
    public function __construct(
        EntityManagerInterface $em,
        LoggerInterface $logger,
        HttpClientInterface $client,
        Filesystem $filesystem,
        KernelInterface $kernel,
        SerializerInterface $serializer,
        string $name = null)
    {
        parent::__construct($name);
        $this->em = $em;
        $this->logger = $logger;
        $this->client = $client;
        $this->filesystem = $filesystem;
        $this->kernel = $kernel;
        $this->serializer = $serializer;
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
        AllIndexationSteps::execute($this->em, $this->logger, $output, $this->client, $this->filesystem, $this->kernel->getProjectDir(), $this->serializer);
        $io->success('Indexation has been successfully completed.');

        return 0;
    }
}
