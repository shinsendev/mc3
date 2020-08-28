<?php

namespace App\Command;

use App\Component\Error\Mc3Error;
use App\Component\Model\ModelConstants;
use App\Component\Stats\StatsGenerator;
use App\Component\Stats\StatsHandler;
use App\Entity\Attribute;
use App\Entity\Person;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class StatsPersonUpdateCommand extends Command
{
    protected static $defaultName = 'stats:person:update';

    /** @var EntityManagerInterface */
    private $em;

    public function __construct(EntityManagerInterface $em, string $name = null)
    {
        parent::__construct($name);
        $this->em = $em;
    }

    protected function configure()
    {
        $this
            ->setDescription('Update stats for Person, if you add a person uuid, update only one person')
            ->addArgument('elementUuid', InputArgument::OPTIONAL, 'Optional : the uuid of the person you will update')
        ;
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $message = StatsHandler::handle($input, $output, ModelConstants::PERSON_MODEL, StatsGenerator::PERSON_STRATEGY, $this->em->getRepository(Person::class), $this->em);
        $io->success($message);

        return 0;
    }
}
