<?php
namespace App\ValueObjects;

use App\Http\Services\Helpers;
use Exception;
use InvalidArgumentException;

class Cpf {
    public function __construct(private readonly string $cpf)
    {
    }

    public static function fromString(string $cpf): Cpf
    {
        if (!Helpers::verifyCPF($cpf)) {
            throw new InvalidArgumentException('CPF inválido');
        }

        return new self($cpf);
    }

    // Get CPF simple
    public function get() : string {
        return $this->cpf;
    }

    // Get CPF masked
    public function get_masked() : string {
        return Helpers::addCPFMask($this->cpf);
    }
}