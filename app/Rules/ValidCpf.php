<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class ValidCpf implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (!$this->isValidFormat($value)) {
            $fail('The :attribute format is invalid.');
        }

        $cpf = $this->cleanCpf($value);

        if (!$this->hasValidLength($cpf)) {
            $fail('The :attribute has an invalid length.');
        }

        if (!$this->hasValidDigits($cpf)) {
            $fail('The :attribute is invalid.');
        }
    }

    private function isValidFormat(string $cpf): bool
    {
        return preg_match('/^\d{3}\.\d{3}\.\d{3}-\d{2}$/', $cpf);
    }

    private function cleanCpf(string $cpf): string
    {
        return preg_replace('/[^0-9]/', '', $cpf);
    }

    private function hasValidLength(string $cpf): bool
    {
        return strlen($cpf) === 11;
    }

    private function hasValidDigits(string $cpf): bool
    {
        [$firstDigit, $secondDigit] = $this->calculateVerificationDigits($cpf);
        return intval($cpf[9]) === $firstDigit && intval($cpf[10]) === $secondDigit;
    }

    private function calculateVerificationDigits(string $cpf): array
    {
        $sumOfDigits = 0;
        $weight = 10;

        for ($t = 0; $t < 9; $t++) {
            $sumOfDigits += intval($cpf[$t]) * $weight--;
        }
        $firstDigit = 11 - ($sumOfDigits % 11);


        $sumOfDigits = 0;
        $weight = 11;

        for ($t = 0; $t < 10; $t++) {
            $sumOfDigits += intval($cpf[$t]) * $weight--;
        }
        $secondDigit = 11 - ($sumOfDigits % 11);

        return [$firstDigit, $secondDigit];
    }

}
