<?php

require './vendor/autoload.php';

use AcmeWidget\Basket;
use AcmeWidget\DeliveryRule;
use AcmeWidget\Product;
use AcmeWidget\BuyOneGetOneHalfPrice;

$catalogue = [
    'R01' => new Product('R01', 'Red Widget', 32.95),
    'G01' => new Product('G01', 'Green Widget', 24.95),
    'B01' => new Product('B01', 'Blue Widget', 7.95)
];

$deliveryRules = [
    new DeliveryRule(50, 4.95),
    new DeliveryRule(90, 2.95),
    new DeliveryRule(PHP_INT_MAX, 0.00)
];

$offer = new BuyOneGetOneHalfPrice('R01');

$basket = new Basket($catalogue, $deliveryRules, $offer);
$basket->add('B01');
$basket->add('G01');
echo 'Total: ' . $basket->total(); // Should print 37.85
