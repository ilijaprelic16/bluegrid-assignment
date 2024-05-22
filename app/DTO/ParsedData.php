<?php

namespace App\DTO;

use Illuminate\Support\Collection;

class ParsedData
{
    private string $host;
    private array $directories;

    public function getHost(): string
    {
        return $this->host;
    }

    public function setHost(string $host): void
    {
        $this->host = $host;
    }

    public function getDirectories(): array
    {
        return $this->directories;
    }

    public function setDirectories(array $directories): void
    {
        $this->directories = $directories;
    }



}
