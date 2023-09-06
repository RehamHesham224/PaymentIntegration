<?php

namespace App\Http\Gateways;

use Illuminate\Support\Facades\Http;

class Fawaterk
{

   const BASE_URL = 'https://staging.fawaterk.com/api/v2';
   const TOKEN='d83a5d07aaeb8442dcbe259e6dae80a3f2e21a3a581e1a5acd';//from config

    //---------------------------------Gateway Integration------------------------------
    public function getPaymentmethods(){

        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer '.self::TOKEN,
        ])->get(self::BASE_URL.'/getPaymentmethods');

        $paymentMethods = $response->json()['data'];

        return $paymentMethods;
    }

    public function executePayment()
    {
        $user=[
            'first_name' => 'mohammad',
            'last_name' => 'hamza',
            'email' => 'test@fawaterk.com',
            'phone' => '01xxxxxxxxx',
            'address' => 'test address',
        ];
        $urls=[
            'successUrl' => 'https://dev.fawaterk.com/success',
            'failUrl' => 'https://dev.fawaterk.com/fail',
            'pendingUrl' => 'https://dev.fawaterk.com/pending',
        ];
        $items=[
            [
                'name' => 'this is test oop 112252',
                'price' => '25',
                'quantity' => '1',
            ],
            [
                'name' => 'this is test oop 112252',
                'price' => '25',
                'quantity' => '1',
            ],
        ];
        $currency='EGP';
        $cartTotal='50';
        $payment_method_id=2;

        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer '.self::TOKEN,
        ])->post(self::BASE_URL.'/invoiceInitPay', [
            'payment_method_id' => $payment_method_id,
            'cartTotal' => $cartTotal,
            'currency' => $currency,
            'customer' => $user,
            'redirectionUrls' => $urls,
            'cartItems' => $items,
        ]);

        // Handle the response as needed
        $responseData = $response->json();
        dd($responseData);
//        return $responseData;

        // You can access the response data like $responseData['status'] and $responseData['data']

        // Add your logic here to handle the payment response
    }
    //-----------------------------------CREATE INVOICE LINK -------------------------
    public function sendPayment()
    {
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer '.self::TOKEN,
        ])->post(self::BASE_URL.'/createInvoiceLink', [
            'cartTotal' => '50',
            'currency' => 'EGP',
            'customer' => [
                'first_name' => 'mohammad',
                'last_name' => 'hamza',
                'email' => 'test@fawaterk.com',
                'phone' => '011252523655',
                'address' => 'test address',
            ],
            'redirectionUrls' => [
                'successUrl' => 'https://dev.fawaterk.com/success',
                'failUrl' => 'https://dev.fawaterk.com/fail',
                'pendingUrl' => 'https://dev.fawaterk.com/pending',
            ],
            'cartItems' => [
                [
                    'name' => 'this is test oop 112252',
                    'price' => '25',
                    'quantity' => '1',
                ],
                [
                    'name' => 'this is test oop 112252',
                    'price' => '25',
                    'quantity' => '1',
                ],
            ],
        ]);

        $responseData = $response->json();
        dd($responseData);

        // You can handle the response here as needed
        // For example, you can return it, store it, or process it further

//        return $responseData;
    }
    public function createCardTokenization()
    {
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer '.self::TOKEN,
        ])->post(self::BASE_URL.'/createCardTokenization', [
            'order' => [
                'currency' => 'EGP',
            ],
            'customerData' => [
                'customer_unique_id' => '222111333',
                'customer_first_name' => 'Fname',
                'customer_last_name' => 'Lname',
                'customer_email' => 'usr@fawaterk.com',
                'customer_phone' => '01111111111',
            ],
            'cardData' => [
                'card_number' => '5123450000000008',
                'expire_year' => '2027',
                'expire_month' => '12',
                'sec_code' => '100',
            ],
        ]);

        $responseData = $response->body();

        // You can handle the response here as needed
        // For example, you can return it, store it, or process it further

        return $responseData;
    }
    public function getTransactionData(){
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer '.self::TOKEN,
        ])->get(self::BASE_URL.'/getInvoiceData/1001267');

        echo $response->body();
    }

}
