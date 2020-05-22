<?php

declare(strict_types=1);


namespace App\Component\DTO\Nested;

use Doctrine\ORM\EntityManagerInterface;

/**
 * Class FilmNestedDTO
 * @package App\Component\DTO\Nested
 */
class FilmNestedDTO
{
    /** @var string */
    private $title;

    /** @var string */
    private $uuid;

    /**
     * @param array $data
     * @param EntityManagerInterface $em
     */
    public function hydrate(array $data, EntityManagerInterface $em):void
    {
        $film = $data['film'];
        $this->setTitle($film['title']);
        $this->setUuid($film['uuid']);
    }

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
    public function getUuid()
    {
        return $this->uuid;
    }

    /**
     * @param mixed $uuid
     */
    public function setUuid($uuid): void
    {
        $this->uuid = $uuid;
    }
}