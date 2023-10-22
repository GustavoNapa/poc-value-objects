<?php
namespace App\ValueObjects;

class Cpf {

    private string $cpf;

    public function __construct(string $value)
    {
        $this->cpf = $value;
    }
}