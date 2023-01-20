<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require 'controller/vendor/autoload.php';

function generateRandomString($length) {
    return substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)) )),1,$length);
}


// This is your test secret API key.
\Stripe\Stripe::setApiKey('sk_test_51MS3v0HQaSk8iKL26ZWmgJNeCFwOB8Hj465uVUN6YJLfAU7EzYSsX1XgKa0aTBxg0vv6qYLfAlS3jkulNmR5IxaV00ML9D7n8i');


$YOUR_DOMAIN = 'http://mangaflow.ninja/';

$productsForStripe = [];



foreach($basket as $product){
    $price = [
        'currency' => 'eur',
        'product_data' => [
            'name' => $product[0]->getName(),
        ],
        'unit_amount' => $product[0]->getPrice() * 100
    ];


    
    
    array_push($productsForStripe, ['price_data' => $price,'quantity' => $product[1]]);


}


$_SESSION['payementId'] = hash('sha256',generateRandomString(8));

$checkout_session = \Stripe\Checkout\Session::create([
    'line_items' => $productsForStripe,
    'mode' => 'payment',
    'success_url' => $YOUR_DOMAIN . 'index.php?Payement=Success&id='.$_SESSION['payementId'],
    'cancel_url' => $YOUR_DOMAIN . '?Cancel',
]);

header("HTTP/1.1 303 See Other");
header("Location: " . $checkout_session->url);