<?php


namespace App\Component\DTO\Export;

use App\Component\Error\Mc3Error;
use App\Component\Exporter\ExportFactory;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Serializer\SerializerInterface;


class ExportHandler
{
    const AUTHORIZED_FORMAT = ['csv', 'json'];

    public static function handle(
        Filesystem $filesystem,
        EntityManagerInterface $em,
        string $projectDir,
        InputInterface $input,
        OutputInterface $output,
        SerializerInterface $serializer
    ):void
    {
        if ($format = $input->getArgument('format')) {
            if (!in_array($format, self::AUTHORIZED_FORMAT)) {
                throw new Mc3Error('Format '.$format.' is not authorized for export.');
            }
            $output->writeln(self::export($filesystem, $em, $projectDir, $format, $serializer));
        }
        // if there is no argument we export for all authorized format
        else {
            foreach (self::AUTHORIZED_FORMAT as $format) {
                $output->writeln(self::export($filesystem, $em, $projectDir, $format, $serializer));
            }
        }
    }

    public static function export(Filesystem $filesystem, EntityManagerInterface $em, string $projectDir, string $format, SerializerInterface $serializer):string
    {
        $export = ExportFactory::create($filesystem, $em, $projectDir, $format, new \DateTime(), $serializer);

        return strtoupper($format).': '.$export->execute();
    }
}
