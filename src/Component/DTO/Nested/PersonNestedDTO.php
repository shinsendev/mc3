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
    /** @var void|string */
    private $firstname;

    /** @var void|string */
    private $lastname;

    /** @var void|string */
    private $groupname;

    /**
     * @param array $data
     * @param EntityManagerInterface $em
     */
    public function hydrate(array $data, EntityManagerInterface $em)
    {
        /** @var Person $person */
        $person = $data['person'];

        // if it's a group, no need to get first and last names
        if ($person->getGroupname()) {
            $this->setGroupname($this->getGroupname());
        }

        else {
            if ($person->getFirstname()) {
                $this->setFirstname($person->getFirstname());
            }

            if ($person->getLastname()) {
                $this->setLastname($person->getLastname());
            }
        }

        $this->setUuid($person->getUuid());
    }

    /**
     * @return string
     */
    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    /**
     * @param string $firstname
     */
    public function setFirstname(string $firstname): void
    {
        $this->firstname = $firstname;
    }

    /**
     * @return string
     */
    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    /**
     * @param string $lastname
     */
    public function setLastname(string $lastname): void
    {
        $this->lastname = $lastname;
    }

    /**
     * @return string
     */
    public function getGroupname(): ?string
    {
        return $this->groupname;
    }

    /**
     * @param string $groupname
     */
    public function setGroupname(string $groupname): void
    {
        $this->groupname = $groupname;
    }

}