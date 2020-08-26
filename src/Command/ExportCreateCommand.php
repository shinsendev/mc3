<?php

namespace App\Command;

use App\Component\DTO\Export\ExportHandler;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpKernel\KernelInterface;

class ExportCreateCommand extends Command
{
    protected static $defaultName = 'export:create';

    private EntityManagerInterface $em;
    private LoggerInterface $logger;
    private Filesystem $filesystem;
    private KernelInterface $kernel;

    /**
     * ExportCreateCommand constructor.
     * @param EntityManagerInterface $em
     * @param LoggerInterface $logger
     * @param Filesystem $filesystem
     * @param KernelInterface $kernel
     * @param null $name
     */
    public function __construct(
        EntityManagerInterface $em,
        LoggerInterface $logger,
        Filesystem $filesystem,
        KernelInterface $kernel,
        $name = null
    )
    {
        parent::__construct($name);
        $this->em = $em;
        $this->logger = $logger;
        $this->filesystem = $filesystem;
        $this->kernel = $kernel;
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
        $io = new SymfonyStyle($input, $output);
        $output->writeln('Export just starts.');
        ExportHandler::handle($this->filesystem, $this->em, $this->kernel->getProjectDir(), $input, $output);
        $io->success('Export operations have been done successfully!');

        return 0;
    }

}
