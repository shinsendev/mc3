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
    /** @var string */
    private $title;

    /** @var string */
    private $model;

    public function hydrate(array $data, EntityManagerInterface $em)
    {
        $element = $data['element'];
        $this->setTitle($element['title']);
        $this->setUuid($element['uuid']);
        $this->setModel($element['model']);
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
    public function getModel(): string
    {
        return $this->model;
    }

    /**
     * @param string $model
     */
    public function setModel(string $model): void
    {
        $this->model = $model;
    }

}