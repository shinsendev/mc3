<?php

declare(strict_types=1);

namespace App\Component\DTO\Payload;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Component\DTO\Hierarchy\AbstractUniqueDTO;
use App\Component\DTO\Nested\NumberNestedDTO;
use App\Component\Factory\DTOFactory;
use App\Component\Hydrator\Strategy\NestedFilmInSongHydrator;
use App\Component\Model\ModelConstants;
use App\Entity\Song;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Tools\Pagination\Paginator;

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
    private $year = 0;

    /** @var string */
    private $externalId;

    /** @var NumberNestedDTO[] */
    private $numbers;

    /** @var array */
    private $films;

    /**
     * @param array $data
     * @param EntityManagerInterface $em
     */
    public function hydrate(array $data, EntityManagerInterface $em):void
    {
        $song = $data['song'];
        $this->setTitle($song->getTitle());

        if ($song->getYear()){
            $this->setYear($song->getYear());
        }

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
        $query = $em->getRepository(Song::class)->getFilmsQuery($song->getUuid());
        $films = new Paginator($query, $fetchJoinCollection = true);

        foreach($films as $film) {
            $filmPayload = DTOFactory::create(ModelConstants::FILM_PAYLOAD_MODEL);
            $filmPayload = NestedFilmInSongHydrator::hydrate($filmPayload, ['film' => $film], $em);
            $nestedFilmsListDTO[] = $filmPayload;
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
    public function getYear(): int
    {
        return $this->year;
    }

    /**
     * @param int $year
     */
    public function setYear(int $year): void
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
     * @return array
     */
    public function getFilms(): ?array
    {
        return $this->films;
    }

    /**
     * @param array $films
     */
    public function setFilms(array $films): void
    {
        $this->films = $films;
    }
}