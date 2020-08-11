<?php


namespace App\Component\DTO\User;


use App\Component\DTO\Definition\DTOInterface;

class UserInputDTO extends AbstractUserDTO implements DTOInterface
{
    private string $password;

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param string $password
     */
    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

}