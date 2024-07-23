<?php

namespace AcmeWidget;

class Basket
{
    private array $products = [];
    private array $catalogue;
    private array $deliveryRules;
    private Offer $offer;

    public function __construct(array $catalogue, array $deliveryRules, Offer $offer)
    {
        $this->catalogue = $catalogue;
        $this->deliveryRules = $deliveryRules;
        $this->offer = $offer;
    }

    public function add(string $productCode)
    {
        if (!isset($this->catalogue[$productCode])) {
            throw new \Exception("Product code not found: $productCode");
        }

        $this->products[] = $this->catalogue[$productCode];
    }

    public function total(): string
    {
        $total = $this->offer->apply($this->products);

        // Calculate delivery cost
        $deliveryCost = 0.0;
        foreach ($this->deliveryRules as $rule) {
            if ($total < $rule->getThreshold()) {
                $deliveryCost = $rule->getCost();
                break;
            }
        }

        $total += $deliveryCost;

        return number_format($total, 2, '.', '');
    }
}
