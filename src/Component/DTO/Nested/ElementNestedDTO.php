<?php

declare(strict_types=1);


namespace App\Component\DTO\Nested;

use App\Component\DTO\Hierarchy\AbstractUniqueDTO;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Class ElementNestedDTO
 * @package App\Component\DTO\Nested
 */
class ElementNestedDTO extends AbstractUniqueDTO
{
    private string $title;
    private array $years = []; // film(s) released for film and number, and songs, it is possible to have many years only for songs

    public function hydrate(array $data, EntityManagerInterface $em)
    {
        $element = $data['element'];
        $this->setTitle($element['title']);
        $this->setUuid($element['uuid']);
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
     * @return array
     */
    public function getYears(): array
    {
        return $this->years;
    }

    /**
     * @param array $years
     */
    public function setYears(array $years): void
    {
        $this->years = $years;
    }

}