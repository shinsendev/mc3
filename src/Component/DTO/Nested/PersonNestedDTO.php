<?php

declare(strict_types=1);


namespace App\Component\DTO\Nested;

use App\Component\DTO\Hierarchy\AbstractUniqueDTO;
use App\Entity\Person;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Class ElementNestedDTO
 * @package App\Component\DTO\Nested
 */
class PersonNestedDTO extends AbstractUniqueDTO
{
    private string $fullname = '';
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