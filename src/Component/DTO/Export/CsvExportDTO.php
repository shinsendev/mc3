<?php

namespace App\Component\DTO\Export;

use App\Component\DTO\Definition\DTOInterface;
use App\Component\DTO\Export\Composition\FilmCsvExportDTO;
use App\Component\DTO\Export\Composition\NumberCsvExportDTO;
use App\Component\DTO\Export\Composition\SongCsvExportDTO;

class CsvExportDTO implements DTOInterface
{
    use FilmCsvExportDTO, NumberCsvExportDTO, SongCsvExportDTO;

}