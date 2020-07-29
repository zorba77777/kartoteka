<?php

class PrimeNumberCalculator
{
    public static function isPrimeNumber(int $number): string
    {
        if ($number == 1) {
            return 'Нет';
        }

        for ($i = 2; $i <= sqrt($number); $i++) {
            if ($number % $i == 0)
                return 'Нет';
        }
        return 'Да';
    }
}