<?php

declare(strict_types=1);

namespace App\Component\DTO\Nested;

use App\Component\DTO\Hierarchy\AbstractUniqueDTO;

/**
 * Class NumberNestedDTO
 * @package App\Component\DTO\Nested
 */
class PersonNestedInPersonDTO extends AbstractUniqueDTO
{
    const NO_VALUE = 'blank';

    private string $fullname = self::NO_VALUE;
    private string $gender = self::NO_VALUE;
    private string $type= self::NO_VALUE; // group or person
    private string $profession = self::NO_VALUE;

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

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType(string $type): void
    {
        $this->type = $type;
    }

    /**
     * @return string
     */
    public function getProfession(): string
    {
        return $this->profession;
    }

    /**
     * @param string $profession
     */
    public function setProfession(string $profession): void
    {
        $this->profession = $profession;
    }

}