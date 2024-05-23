<?php

namespace App\DTO;


class ParsedData {
    private array $data;

    public function __construct(array $data) {
        $this->data = $data;
    }

    public function getData(): array
    {
        return $this->data;
    }
}
