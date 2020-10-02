<?php

declare(strict_types=1);


namespace App\Component\DTO\Nested;

use App\Component\DTO\Hierarchy\AbstractUniqueDTO;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * Class ElementNestedDTO
 * @package App\Component\DTO\Nested
 */
class PersonNestedDTO extends AbstractUniqueDTO
{
    /**
     * @Groups({"export"})
     */
    private string $fullname = '';

    /**
     * @Groups({"export"})
     */
    private string $gender = '';

    /**
     * @return string
     */
    public function getFullname(): string
    {
        return $this->fullname;
    }

    /**
     * @param string $fullname
     */
    public function setFullname(string $fullname): void
    {
        $this->fullname = $fullname;
    }

    /**
     * @return string
     */
    public function getGender(): string
    {
        return $this->gender;
    }

    /**
     * @param string $gender
     */
    public function setGender(string $gender): void
    {
        $this->gender = $gender;
    }

}
