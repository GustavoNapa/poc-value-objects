<?php
namespace App\ValueObjects;

use App\Http\Services\Helpers;
use Exception;

class Cpf {

    private string $cpf;

    public function __construct(string $value)
    {
        // Verify if is valid
        if(!Helpers::verifyCPF($value)){
            throw new Exception("CPF inválido", 401);
        }

        $this->cpf = Helpers::removeMaskCPFCNPJ($value);
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