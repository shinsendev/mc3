<?php

declare(strict_types=1);


namespace App\Component\DTO\Nested;

use App\Component\DTO\Hierarchy\AbstractUniqueDTO;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Class FilmNestedDTO
 * @package App\Component\DTO\Nested
 */
class FilmNestedDTO extends AbstractUniqueDTO
{
    /** @var string */
    private $title;

    /** @var int|void */
    private $released;


    /**
     * @param array $data
     * @param EntityManagerInterface $em
     */
    public function hydrate(array $data, EntityManagerInterface $em):void
    {
        $film = $data['film'];
        $this->setTitle($film['title']);
        $this->setUuid($film['uuid']);
        if (isset($data['released'])) {
            $this->setReleased($data['released']);
        }
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
     * @return int|void
     */
    public function getReleased()
    {
        return $this->released;
    }

    /**
     * @param int|void $released
     */
    public function setReleased($released): void
    {
        $this->released = $released;
    }

}