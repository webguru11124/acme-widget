<?php

namespace AcmeWidget;

interface Offer
{
    public function apply(array $products): float;
}

class BuyOneGetOneHalfPrice implements Offer
{
    private string $productCode;

    public function __construct(string $productCode)
    {
        $this->productCode = $productCode;
    }

    public function apply(array $products): float
    {
        $total = 0.0;
        $count = 0;
        
        foreach ($products as $product) {
            if ($product->getCode() === $this->productCode) {
                $count++;
                $total += $product->getPrice();
                if ($count % 2 == 0) {
                    $total -= $product->getPrice() / 2;
                }
            } else {
                $total += $product->getPrice();
            }
        }
        
        return $total;
    }
}
