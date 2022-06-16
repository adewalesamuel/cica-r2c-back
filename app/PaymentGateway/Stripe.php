<?php

namespace App\PaymentGateway;

class Stripe {

    const PRICE_ID_MAP = [
        '140' => 'price_1LBGDhHrX6v7W788R2NyHmNo',
        '205' => 'price_1LBGDsHrX6v7W788A4A3db9O',
        '240' => 'price_1LBGDxHrX6v7W788MhNZNVoK',
        '225' => 'price_1LBGEDHrX6v7W788f32lNL2m',
        '285' => 'price_1LBGEMHrX6v7W788Z9TvGWgs'
    ];

    public static function getCheckoutUrl($price, string $payment_id = ""): string {
        self::setApiKey();
        return self::createPaymentSession($price, $payment_id)->url;
    }

    private static function createPaymentSession($price, string $payment_id) {        
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

    private static function setApiKey() {
        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
    }
    
}