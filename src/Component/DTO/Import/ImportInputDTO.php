<?php

namespace App\Component\DTO\Import;

use App\Component\DTO\Definition\DTOInterface;

class ImportInputDTO extends AbstractImportDTO implements DTOInterface
{
    private string $accessToken;

    /**
     * @return string
     */
    public function getAccessToken(): string
    {
        return $this->accessToken;
    }

    /**
     * @param string $accessToken
     */
    public function setAccessToken(string $accessToken): void
    {
        $this->accessToken = $accessToken;
    }

}