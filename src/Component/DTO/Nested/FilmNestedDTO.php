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
    private $releasedYear;

    /** @var int|void */
    private $imdb;

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
    public function getReleasedYear()
    {
        return $this->releasedYear;
    }

    /**
     * @param int|void $releasedYear
     */
    public function setReleasedYear($releasedYear): void
    {
        $this->releasedYear = $releasedYear;
    }

    /**
     * @return int|void
     */
    public function getImdb()
    {
        return $this->imdb;
    }

    /**
     * @param int|void $imdb
     */
    public function setImdb($imdb): void
    {
        $this->imdb = $imdb;
    }

}