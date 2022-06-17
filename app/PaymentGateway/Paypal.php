<?php

namespace App\PaymentGateway;

use Srmklive\PayPal\Services\PayPal as PayPalClient;

class Paypal {

    public static function getCheckoutUrl($price, string $payment_id = ""): string
    {
        $provider = self::paypalInit();

        $response = $provider->createOrder([
            "intent" => "CAPTURE",
            "application_context" => [
                "return_url" => env('PAYMENT_URL') . "?success=true&payment_id={$payment_id}",
                "cancel_url" => env('PAYMENT_URL') . "?canceled=true&payment_id={$payment_id}",
            ],
            "purchase_units" => [
                0 => [
                    "amount" => [
                        "currency_code" => "EUR",
                        "value" => $price
                    ]
                ]
            ]
        ]);

        if (isset($response['id']) && $response['id'] != null) {

            // redirect to approve href
            foreach ($response['links'] as $links) {
                if ($links['rel'] == 'approve') {
                    return $links['href'];
                }
            }

            throw new \Exception("Une erreure esr survenue", 1);
        } else {
            throw new \Exception("Une erreure esr survenue " . $response['error']['message'] ?? "", 1);
        }
    }

    public static function paypalInit() 
    {
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $paypalToken = $provider->getAccessToken();
        
        return $provider;
    }   

}