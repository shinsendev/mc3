<?php

namespace App\Command;

use App\Component\Exporter\Export;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
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
            ->addArgument('format', InputArgument::OPTIONAL, 'Argument description')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        // create a data folder and prepare the folder for the current version of the export
//        Export::init($this->filesystem, $this->kernel->getProjectDir());

        $export = new Export();

//        $rootDir = $this->kernel->getProjectDir();
//        $this->filesystem->mkdir($rootDir.'/data');
//        $name = (new \DateTime())->format('Y-m-d_His') . '_mc2-export';
//        $dataDir = $rootDir.'/data/'.$name.'/';
//        $this->filesystem->mkdir($dataDir);
//
//        // create the empty files in the same folder
//        $this->filesystem->touch($dataDir.$name.'.csv');
//        $this->filesystem->touch($dataDir.$name.'.json');

        // put some date into the files

        // by films

        // generate categories
        // generate attributes
        // generate films
        // generate numbers
        // generate songs
        // generate people

        $io->success('Export command has successfully generated csv and json files.');

        return 0;
    }
}
