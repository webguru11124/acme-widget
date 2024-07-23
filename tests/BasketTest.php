<?php

namespace AcmeWidget\Tests;

use PHPUnit\Framework\TestCase;
use AcmeWidget\Basket;
use AcmeWidget\Product;
use AcmeWidget\DeliveryRule;
use AcmeWidget\BuyOneGetOneHalfPrice;

class BasketTest extends TestCase
{
    private $catalogue;
    private $deliveryRules;
    private $offer;

    protected function setUp(): void
    {
        $this->catalogue = [
            'R01' => new Product('R01', 'Red Widget', 32.95),
            'G01' => new Product('G01', 'Green Widget', 24.95),
            'B01' => new Product('B01', 'Blue Widget', 7.95)
        ];

        $this->deliveryRules = [
            new DeliveryRule(50, 4.95),
            new DeliveryRule(90, 2.95),
            new DeliveryRule(PHP_INT_MAX, 0.00)
        ];

        $this->offer = new BuyOneGetOneHalfPrice('R01');
    }

    public function testBasketTotal()
    {
        $basket = new Basket($this->catalogue, $this->deliveryRules, $this->offer);
        $basket->add('B01');
        $basket->add('G01');
        $this->assertEquals('37.85', $basket->total());

        $basket = new Basket($this->catalogue, $this->deliveryRules, $this->offer);
        $basket->add('R01');
        $basket->add('R01');
        $this->assertEquals('54.38', $basket->total());

        $basket = new Basket($this->catalogue, $this->deliveryRules, $this->offer);
        $basket->add('R01');
        $basket->add('G01');
        $this->assertEquals('60.85', $basket->total());

        $basket = new Basket($this->catalogue, $this->deliveryRules, $this->offer);
        $basket->add('B01');
        $basket->add('B01');
        $basket->add('R01');
        $basket->add('R01');
        $basket->add('R01');
        $this->assertEquals('98.28', $basket->total());
    }
}
