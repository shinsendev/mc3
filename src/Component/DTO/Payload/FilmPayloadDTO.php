<?php

declare(strict_types=1);


namespace App\Component\DTO\Payload;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Component\DTO\Composition\UniqueDTOTrait;

/**
 * Class NarrativeDTO
 * @package App\Component\DTO
 * @ApiResource(
 *     shortName="film"
 * )
 */
class FilmPayloadDTO
{
    use UniqueDTOTrait;

    //film infos

    private $title;

    private $imdb;

    //stats

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title): void
    {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getImdb()
    {
        return $this->imdb;
    }

    /**
     * @param mixed $imdb
     */
    public function setImdb($imdb): void
    {
        $this->imdb = $imdb;
    }
}