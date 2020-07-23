<?php

declare(strict_types=1);

namespace App\Component\DTO\Nested;

use App\Component\DTO\Hierarchy\AbstractUniqueDTO;

/**
 * Class AttributeNestedDTOinCategory
 * @package App\Component\DTO\Nested
 */
class AttributeNestedDTO extends AbstractUniqueDTO
{
    /** @var string */
    private $title = '';

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

}