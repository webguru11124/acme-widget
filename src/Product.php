<?php

namespace AcmeWidget;

class Product
{
    private string $code;
    private string $name;
    private float $price;

    public function __construct(string $code, string $name, float $price)
    {
        $this->code = $code;
        $this->name = $name;
        $this->price = $price;
    }

    public function getCode(): string
    {
        return $this->code;
    }

    public function getPrice(): float
    {
        return $this->price;
    }
}
