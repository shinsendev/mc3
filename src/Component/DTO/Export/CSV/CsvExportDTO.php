<?php

namespace App\Component\DTO\Export\CSV;

use App\Component\DTO\Definition\DTOInterface;

class CsvExportDTO implements DTOInterface
{
    use FilmCsvExportDTO, NumberCsvExportDTO, SongCsvExportDTO;

}