<?php

declare(strict_types=1);


namespace App\Component\DTO\Nested;

use App\Component\DTO\Hierarchy\AbstractUniqueDTO;

class FilmNestedInPersonDTO extends AbstractUniqueDTO
{
    //  title, released data, total length of the numbers in the film,  total length of the numbers with person in the film, ratio is computed on client side

    /** @var string */
    private $title;

    /** @var int */
    private $releasedYear = 0;

    /** @var int */
    private $totalNumberLength = 0;

    /** @var int */
    private $totalNumberLengthForPerson = 0;

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
    public function getReleasedYear(): int
    {
        return $this->releasedYear;
    }

    /**
     * @param int $releasedYear
     */
    public function setReleasedYear(int $releasedYear): void
    {
        $this->releasedYear = $releasedYear;
    }

    /**
     * @return int
     */
    public function getTotalNumberLength(): int
    {
        return $this->totalNumberLength;
    }

    /**
     * @param int $totalNumberLength
     */
    public function setTotalNumberLength(int $totalNumberLength): void
    {
        $this->totalNumberLength = $totalNumberLength;
    }

    /**
     * @return int
     */
    public function getTotalNumberLengthForPerson(): int
    {
        return $this->totalNumberLengthForPerson;
    }

    /**
     * @param int $totalNumberLengthForPerson
     */
    public function setTotalNumberLengthForPerson(int $totalNumberLengthForPerson): void
    {
        $this->totalNumberLengthForPerson = $totalNumberLengthForPerson;
    }

}