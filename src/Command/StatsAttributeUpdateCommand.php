<?php

namespace App\Command;

use App\Component\Error\Mc3Error;
use App\Component\Model\ModelConstants;
use App\Component\Stats\StatsGenerator;
use App\Component\Stats\StatsHandler;
use App\Entity\Attribute;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class StatsAttributeUpdateCommand extends Command
{
    protected static $defaultName = 'stats:attribute:update';

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
            ->addArgument('attributeUuid', InputArgument::OPTIONAL, 'Optional : the uuid of the attribute you will update')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $message = StatsHandler::handle($input, $output, ModelConstants::ATTRIBUTE_MODEL, StatsGenerator::ATTRIBUTE_STRATEGY, $this->em->getRepository(Attribute::class), $this->em);
        $io->success($message);

        return 0;
    }

}
