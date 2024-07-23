<?php

require __DIR__ . '/../vendor/autoload.php';

// Debugging: Check if class exists
if (!class_exists(\AcmeWidget\BuyOneGetOneHalfPrice::class)) {
    echo "Class BuyOneGetOneHalfPrice not found. Please check the namespace and autoloading.\n";
    exit(1);
}
