<?php

require 'vendor/autoload.php';
// This is your test secret API key.
\Stripe\Stripe::setApiKey('sk_test_51MS3v0HQaSk8iKL26ZWmgJNeCFwOB8Hj465uVUN6YJLfAU7EzYSsX1XgKa0aTBxg0vv6qYLfAlS3jkulNmR5IxaV00ML9D7n8i');


$YOUR_DOMAIN = 'http://mangaflow.ninja/view/component/payement';

$productsForStripe = [];

foreach($basket as $product){
    array_push($productsForStripe, ['price' => $product->getPrice(),'quantity' => $product[1]]);
}

$checkout_session = \Stripe\Checkout\Session::create([
    'line_items' => $productsForStripe,
    'mode' => 'payment',
    'success_url' => $YOUR_DOMAIN . '/success.html',
    'cancel_url' => $YOUR_DOMAIN . '/cancel.html',
]);

header("HTTP/1.1 303 See Other");
header("Location: " . $checkout_session->url);