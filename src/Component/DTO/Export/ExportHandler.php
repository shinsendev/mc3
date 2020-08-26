<?php


namespace App\Component\DTO\Export;


use App\Component\Error\Mc3Error;
use App\Component\Exporter\ExportFactory;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Filesystem\Filesystem;

class ExportHandler
{
    const AUTHORIZED_FORMAT = ['csv', 'json'];

    public static function handle(Filesystem $filesystem, EntityManagerInterface $em, string $projectDir, InputInterface $input)
    {
        if ($format = $input->getArgument('format')) {
            if (!in_array($format, self::AUTHORIZED_FORMAT)) {
                throw new Mc3Error('Format '.$format.' is not authorized for export.');
            }
            return self::export($filesystem, $em, $projectDir, $format);
        }
        // if there is no argument we export for all authorized format
        else {
            $rsl = '';
            foreach (self::AUTHORIZED_FORMAT as $format) {
                $rsl .= self::export($filesystem, $em, $projectDir, $format);
            }
            return $rsl;
        }
    }

    public static function export(Filesystem $filesystem, EntityManagerInterface $em, string $projectDir, string $format):string
    {
        $csvExport = ExportFactory::create($filesystem, $em, $projectDir, $format, new \DateTime());
        return strtoupper($format).': '.$csvExport->execute();
    }
}