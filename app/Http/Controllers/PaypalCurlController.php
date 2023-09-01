<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Services\PaypalCurlService;
use Illuminate\Http\Request;

class PaypalCurlController extends Controller
{
    public function index()
    {
        return view('welcome');
    }
    public function processPayment(Request $request, PaypalCurlService $service)
    {
        // Set the payment amount from the form input
        $amount = $request->input('amount');

        $response = $service->PaymentCurl($amount);

        // Decode the JSON response
        $responseArray = json_decode($response, true);

        $transaction=Transaction::create([
            'payment_id' => $responseArray['id'],
            'amount'=>$amount,
            'currency' => 'USD',
            'created_at' => now(),
            'status' => 'pending'
        ]);


        // Get the approval link from the response
        $approvalLink = $responseArray['links'][1]['href'];

        // Redirect the user to the PayPal approval link
        return redirect($approvalLink);
    }
    //
    // WelcomeController.php
    public function paymentSuccess()
    {
        // Handle successful payment
        return view('payment.success');
    }

    public function paymentFailed()
    {
        // Handle failed payment
        return view('payment.failed');
    }

}
