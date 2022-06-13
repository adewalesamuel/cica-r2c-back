<?php


namespace App\PaymentGateway;

class Stripe {

    const PRICE_ID_MAP = [
        '140' => 'price_1L9qUCHrX6v7W78860WY5kWI',
        '205' => 'price_1L9qTgHrX6v7W788a47Gd0Ds',
        '240' => 'price_1L9qSSHrX6v7W788KufBjupn',
        '225' => 'price_1L9qQtHrX6v7W788gY57O3pj',
        '285' => 'price_1L9aV6HrX6v7W788eo3UtOXV'
    ];

    private static function setApiKey() {
        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
    }

    private static function createPaymentSession($price, string $payment_id = "") {
        if (!isset(self::PRICE_ID_MAP[$price]))
            throw new \Exception("The price does not exist", 1);

        return \Stripe\Checkout\Session::create([
            'line_items' => [[
                # Provide the exact Price ID (e.g. pr_1234) of the product you want to sell
                'price' => self::PRICE_ID_MAP[(string) $price],
                'quantity' => 1,
              ]],
              'mode' => 'payment',
              'success_url' => env('PAYMENT_URL') . "?success=true&payment_id={$payment_id}",
              'cancel_url' => env('PAYMENT_URL') . "?canceled=true&payment_id={$payment_id}",
              'automatic_tax' => [
                'enabled' => false,
              ],
            ]);
    }
    
    public static function getCheckoutUrl($price): string {
        self::setApiKey();
        return self::createPaymentSession($price)->url;
    }
}