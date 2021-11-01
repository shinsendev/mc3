<?php

namespace App\Command;

use App\Component\Exporter\ExportHandler;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Component\Serializer\SerializerInterface;

class ExportCreateCommand extends Command
{
    protected static $defaultName = 'export:create';

    private EntityManagerInterface $em;
    private LoggerInterface $logger;
    private Filesystem $filesystem;
    private KernelInterface $kernel;
    private SerializerInterface $serializer;

    /**
     * ExportCreateCommand constructor.
     * @param EntityManagerInterface $em
     * @param LoggerInterface $logger
     * @param Filesystem $filesystem
     * @param KernelInterface $kernel
     * @param SerializerInterface $serializer
     * @param null $name
     */
    public function __construct(
        EntityManagerInterface $em,
        LoggerInterface $logger,
        Filesystem $filesystem,
        KernelInterface $kernel,
        SerializerInterface $serializer,
        $name = null
    )
    {
        parent::__construct($name);
        $this->em = $em;
        $this->logger = $logger;
        $this->filesystem = $filesystem;
        $this->kernel = $kernel;
        $this->serializer = $serializer;
    }

    protected function configure()
    {
        $this
            ->setDescription('Export a file with all the website data in CSV and JSON.')
            ->addArgument('format', InputArgument::OPTIONAL, 'Type of format, if not precised exports have done in all formats supported.')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $this->logger->info('Export command is launched');
        $io = new SymfonyStyle($input, $output);
        $output->writeln('Export just starts.');
        ExportHandler::handle($this->filesystem, $this->em, $this->kernel->getProjectDir(), $input, $output, $this->serializer);
        $io->success('Export operations have been done successfully!');

        return 0;
    }

}
