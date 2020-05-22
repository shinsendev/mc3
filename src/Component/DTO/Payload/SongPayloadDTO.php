<?php

declare(strict_types=1);

namespace App\Component\DTO\Payload;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Component\DTO\Hierarchy\AbstractUniqueDTO;
use App\Component\DTO\Nested\FilmNestedDTO;
use App\Component\DTO\Nested\NumberNestedDTO;
use App\Entity\Song;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Class NarrativeDTO
 * @package App\Component\DTO
 * @ApiResource(
 *     shortName="song"
 * )
 */
class SongPayloadDTO extends AbstractUniqueDTO
{
    /** @var string */
    private $title;

    /** @var integer */
    private $year;

    /** @var string */
    private $externalId;

    /** @var NumberNestedDTO[] */
    private $numbers;

    /** @var FilmNestedDTO[] */
    private $films;

    /**
     * @param array $data
     */
    public function hydrate(array $data, EntityManagerInterface $em):void
    {
        $song = $data['song'];
        $this->setTitle($song->getTitle());
        $this->setYear($song->getYear());
        $this->setExternalId($song->getExternalId());
        $this->setUuid($song->getUuid());

        // get nested numbers
        foreach ($song->getNumbers() as $number) {
            $nestedNumberDTO = new NumberNestedDTO();
            $nestedNumberDTO->hydrate(['number' => $number], $em);
            $nestedNumbersListDTO[] = $nestedNumberDTO;
        }

        if (isset($nestedNumbersListDTO)) {
            $this->setNumbers($nestedNumbersListDTO);
        }

        // get nested films (films deduced by numbers linked to song)
        $films = $em->getRepository(Song::class)->getFilms($song->getUuid());

        foreach($films as $film) {
            $nestedFilmDTO = new FilmNestedDTO();
            $nestedFilmDTO->hydrate(['film' => $film], $em);
            $nestedFilmsListDTO[] = $nestedFilmDTO;
        }

        if (isset($nestedFilmsListDTO)) {
            $this->setFilms($nestedFilmsListDTO);
        }
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    /**
     * @return int
     */
    public function getYear(): ?int
    {
        return $this->year;
    }

    /**
     * @param int $year
     */
    public function setYear(?int $year): void
    {
        $this->year = $year;
    }

    /**
     * @return string
     */
    public function getExternalId(): ?string
    {
        return $this->externalId;
    }

    /**
     * @param string $externalId
     */
    public function setExternalId(?string $externalId): void
    {
        $this->externalId = $externalId;
    }

    /**
     * @return NumberNestedDTO[]
     */
    public function getNumbers(): ?array
    {
        return $this->numbers;
    }

    /**
     * @param NumberNestedDTO[] $numbers
     */
    public function setNumbers(array $numbers): void
    {
        $this->numbers = $numbers;
    }

    /**
     * @return FilmNestedDTO[]
     */
    public function getFilms(): ?array
    {
        return $this->films;
    }

    /**
     * @param FilmNestedDTO[] $films
     */
    public function setFilms(array $films): void
    {
        $this->films = $films;
    }

}