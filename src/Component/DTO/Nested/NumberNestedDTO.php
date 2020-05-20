<?php

declare(strict_types=1);

namespace App\Component\DTO\Nested;

use Doctrine\ORM\EntityManagerInterface;

/**
 * Class NumberNestedDTO
 * @package App\Component\DTO\Nested
 */
class NumberNestedDTO
{
    /** @var string */
    private $title;

    /** @var string */
    private $uuid;

    /** @var string */
    private $film;

    public function hydrate(array $data, EntityManagerInterface $em):void
    {
        $number = $data['number'];
        $this->setTitle($number->getTitle());
        $this->setUuid($number->getUuid());
        $this->setFilm($number->getFilm()->getTitle());
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
     * @return string
     */
    public function getUuid(): string
    {
        return $this->uuid;
    }

    /**
     * @param string $uuid
     */
    public function setUuid(string $uuid): void
    {
        $this->uuid = $uuid;
    }

    /**
     * @return string
     */
    public function getFilm(): string
    {
        return $this->film;
    }

    /**
     * @param string $film
     */
    public function setFilm(string $film): void
    {
        $this->film = $film;
    }

}