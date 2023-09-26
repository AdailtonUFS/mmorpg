<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class ValidCpf implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (!preg_match('/^\d{3}\.\d{3}\.\d{3}-\d{2}$/', $value)) {
            $fail('The format is ###.###.###-##');
        }

        $cpfNumber = preg_replace('/[^0-9]/', '', $value);

        if (strlen($cpfNumber) != 11 or preg_match('/(\d)\1{10}/', $cpfNumber)) {
            $fail(':attribute is invalid');
        }

        [$first_digit, $second_digit] = $this->getDigits($cpfNumber);

        if ($first_digit != intval($cpfNumber[9]) || $second_digit != intval($cpfNumber[10])) {
            $fail(':attribute is invalid');
        }
    }

    public function getDigits(string $cpfNumber): array
    {
        $sumOfCpfNumbers = 0;

        for ($i = 0; $i < 9; $i++) {
            $sumOfCpfNumbers += intval($cpfNumber[$i]) * (10 - $i);
        }

        $remainder = $sumOfCpfNumbers % 11;
        $firstDigit = ($remainder < 2) ? 0 : 11 - $remainder;

        $sumOfCpfNumbers += intval($cpfNumber[9]) * (11 - 9);
        $remainder = $sumOfCpfNumbers % 11;
        $secondDigit = ($remainder < 2) ? 0 : 11 - $remainder;

        return [$firstDigit, $secondDigit];
    }
}
