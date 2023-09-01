<?php

namespace App\Services;


class PaypalCurlService
{
    const URL='https://api.sandbox.paypal.com/v1/payments/payment';

    public function PaymentCurl($amount)
    {

    // Build the cURL request
        $ch = curl_init();
    //url CURLOPT_URL
        curl_setopt($ch, CURLOPT_URL, self::URL);
    //transefer
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    //post request
        curl_setopt($ch, CURLOPT_POST, 1);
    //post fields
        curl_setopt($ch, CURLOPT_POSTFIELDS, $this->requestBody($amount));
    //headers
        curl_setopt($ch, CURLOPT_HTTPHEADER, $this->requestHeader());

    // Execute the cURL request and get the response
        $response = curl_exec($ch);
        curl_close($ch);
        return $response;
    }

    public function requestBody($amount)
    {
        return json_encode([
            'intent' => 'sale',
            'payer' => [
                'payment_method' => 'paypal',
            ],
            'transactions' => [
                [
                    'amount' => [
                        'total' => $amount,
                        'currency' => 'USD',
                    ],
                ],
            ],
            'redirect_urls' => [
                'return_url' => route('payment.success'),
                'cancel_url' => route('payment.failed'),
            ],
        ]);
    }

    public function requestHeader()
    {
    // Set your PayPal API credentials
        $clientId = env('PAYPAL_SANDBOX_CLIENT_ID');
        $clientSecret = env('PAYPAL_SANDBOX_CLIENT_SECRET');
        return [
            'Content-Type: application/json',
            'Authorization: Basic ' . base64_encode("$clientId:$clientSecret"),
        ];
    }
}
