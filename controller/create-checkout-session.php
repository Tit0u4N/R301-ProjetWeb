<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
//require_once "model/Tome.php";

require 'controller/vendor/autoload.php';

// This is your test secret API key.
\Stripe\Stripe::setApiKey('sk_test_51MS3v0HQaSk8iKL26ZWmgJNeCFwOB8Hj465uVUN6YJLfAU7EzYSsX1XgKa0aTBxg0vv6qYLfAlS3jkulNmR5IxaV00ML9D7n8i');


$YOUR_DOMAIN = 'http://mangaflow.ninja/view/component/payement';

$productsForStripe = [];



foreach($basket as $product){
    $price = [
        'currency' => 'eur',
        'product_data' => [
            'name' => $product[0]->getName(),
            'images' => [
                "http://mangaflow.ninja/" . $product[0]->getImgPath()
            ],
        ],
        'unit_amount' => $product[0]->getPrice() * 100
    ];


    
    
    array_push($productsForStripe, ['price_data' => $price,'quantity' => $product[1]]);


}



$checkout_session = \Stripe\Checkout\Session::create([
    'line_items' => $productsForStripe,
    'mode' => 'payment',
    'success_url' => $YOUR_DOMAIN . '/success.html',
    'cancel_url' => $YOUR_DOMAIN . '/cancel.html',
]);

echo "lala5";

header("HTTP/1.1 303 See Other");
header("Location: " . $checkout_session->url);