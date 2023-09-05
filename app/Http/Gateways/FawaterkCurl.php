<?php

namespace App\Http\Gateways;

class FawaterkCurl
{

//
//    public  function process(){
//        $cartItems = [
//            [ 'name' => 'Item 1', 'price' => 5, 'quantity' => 1],
//            [ 'name' => 'Item 2', 'price' => 10, 'quantity' => 2]
//        ];
//        $customer = [
//            'name'    => 'John Smith',
//            'email'   => 'john.smith@example.com',
//            'phone'   => '1234567890',
//            'address' => '21st South Park Avenue'
//        ];
//        $shipping = 2;
//        $cartTotal = 27;
//        $redirectUrl = "https://fawaterk.com";
//        $currency = 'EGP';
//
//        $fawaterk = new Fawaterk;
//
//    // fill the object with the correct data
//        $fawaterk->setVendorKey('YOUR_VENDOR_KEY_HERE')
//            ->setCartItems($cartItems)
//            ->setCustomer($customer)
//            ->setShipping($shipping)
//            ->setCartTotal($cartTotal)
//            ->setRedirectUrl($redirectUrl)
//            ->setCurrency($currency);
//
//    // send the request and receive the invoice url
//        $invoiceUrl = $fawaterk->getInvoiceUrl();
//
//    // redirect the user to the invoice url
//        header("Location: {$invoiceUrl}");
//    }

    public function getPaymentMethods(){

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://staging.fawaterk.com/api/v2/getPaymentmethods',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'Authorization: Bearer d83a5d07aaeb8442dcbe259e6dae80a3f2e21a3a581e1a5acd'
            ),
        ));
        $response = curl_exec($curl);
        curl_close($curl);

//        if($response["status"] == "success") {
//            return $response;
//        }
        return $response;

    }
    public function excutePayment(){
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://staging.fawaterk.com/api/v2/invoiceInitPay',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS =>'{
                "payment_method_id": 2,
                "cartTotal": "50",
                "currency": "EGP",
                "customer": {
                    "first_name": "mohammad",
                    "last_name": "hamza",
                    "email": "test@fawaterk.com",
                    "phone": "01xxxxxxxxx",
                    "address": "test address"
                },
                "redirectionUrls": {
                     "successUrl" : "https://dev.fawaterk.com/success",
                     "failUrl": "https://dev.fawaterk.com/fail",
                     "pendingUrl": "https://dev.fawaterk.com/pending"
                },
                "cartItems": [
                    {
                        "name": "this is test oop 112252",
                        "price": "25",
                        "quantity": "1"
                    },
                    {
                        "name": "this is test oop 112252",
                        "price": "25",
                        "quantity": "1"
                    }
                ]
            }',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'Authorization: Bearer d83a5d07aaeb8442dcbe259e6dae80a3f2e21a3a581e1a5acd'
            ),
        ));
        $response = curl_exec($curl);
        curl_close($curl);
    }
    public function sendPayment(){

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://staging.fawaterk.com/api/v2/createInvoiceLink',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => '{
                "cartTotal": "50",
                "currency": "EGP",
                "customer": {
                    "first_name": "mohammad",
                    "last_name": "hamza",
                    "email": "test@fawaterk.com",
                    "phone": "011252523655",
                    "address": "test address"
                },
                "redirectionUrls": {
                     "successUrl" : "https://dev.fawaterk.com/success",
                     "failUrl": "https://dev.fawaterk.com/fail",
                     "pendingUrl": "https://dev.fawaterk.com/pending"
                },
                "cartItems": [
                    {
                        "name": "this is test oop 112252",
                        "price": "25",
                        "quantity": "1"
                    },
                    {
                        "name": "this is test oop 112252",
                        "price": "25",
                        "quantity": "1"
                    }
                ]
            }',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'Authorization: Bearer d83a5d07aaeb8442dcbe259e6dae80a3f2e21a3a581e1a5acd'
            ),
        ));
        $response = curl_exec($curl);
        curl_close($curl);
        echo $response;
    }

}
