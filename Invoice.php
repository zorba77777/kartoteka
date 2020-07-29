<?php

class Invoice
{
    public string $price;
    public string $date;

    public function __construct(float $price = 100, string $date = '2020-01-01')
    {
        $this->price = $price;
        $this->date = $date;
    }

}