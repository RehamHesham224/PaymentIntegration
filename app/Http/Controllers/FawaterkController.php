<?php

namespace App\Http\Controllers;

use App\Http\Gateways\Fawaterk;

class FawaterkController
{
    /**
     * @var Fawaterk
     */
    private $fawaterk;

    public function __construct(Fawaterk $fawaterk)
    {
        $this->fawaterk = $fawaterk;
    }
    public function index()
    {
        // Load payment methods from Fawaterak gateway
        $paymentMethods = $this->fawaterk->getPaymentmethods();

        return view('payment.index', compact('paymentMethods'));
    }

    public function choosePaymentMethod(Request $request)
    {
        $paymentMethodId = $request->input('payment_method_id')??1;
        session(['selected_payment_method' => $paymentMethodId]);
        dd('payment_method chosen');
//        return redirect()->route('cart.index'); // Redirect to the cart page
    }
    public function processPayment(Request $request)
    {
        // Handle your request and gather payment information
        $paymentMethodId = $request->input('payment_method_id')??2;
        $cartItems = $request->input('cart_items')??
            [
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
            ]; // Get cart items and other necessary data
        $totalAmount=$request->input('cart_total')??100;
        // Prepare the payment data
        $paymentData = [
            'payment_method_id' => $paymentMethodId,
            'cartTotal' => $totalAmount, // Total amount to be paid
            'currency' => 'KWD',
            'cartItems' => $cartItems,
            // Add other payment-related data as needed
        ];

        // Create an instance of the Fawaterk gateway

        // Execute the payment
        $paymentResponse = $this->fawaterk->executePayment($paymentData);

        // Handle the payment response and update your application accordingly
        // For example, store payment status and details in your database

        return view('payment.result', compact('paymentResponse'));
    }
    public function createInvoice(Request $request)
    {
        // Handle your request and gather payment information
        $user = $request->user(); // Get the authenticated user
        $orderItems = $request->input('order_items'); // Get cart items
        $paymentMethodId = $request->input('payment_method_id'); // Get selected payment method ID

        // Prepare the payment data
        $paymentData = [
            'customer' => [
                'first_name' => $user->first_name,
                'last_name' => $user->last_name,
                'email' => $user->email,
                'phone' => $user->phone,
                // Add other customer information as needed
            ],
            'cartItems' => $orderItems,
            'currency' => 'EGP',
            'cartTotal' => 100.0, // Total amount to be paid
            'payment_method_id' => $paymentMethodId,
            'redirectionUrls' => [
                'successUrl' => route('payment.success'),
                'failUrl' => route('payment.fail'),
                'pendingUrl' => route('payment.pending'),
            ],
        ];

        // Create an instance of the Fawaterk gateway
        $fawaterk = new Fawaterk();

        // Send the payment request to Fawaterk and get the payment link
        $paymentLink = $fawaterk->sendPayment($paymentData);

        // Redirect the user to the payment link
        return redirect($paymentLink);
    }

    public function success()
    {
        // Payment success logic
        return view('payment.success');
    }

    public function failure()
    {
        // Payment failure logic
        return view('payment.failure');
    }

    public function getTransactionData()
    {
        // Retrieve transaction data from Fawaterak
        $transactionData = $this->fawaterk->getTransactionData();

        return view('payment.transaction-data', compact('transactionData'));
    }
    public function storeCreditCard(Request $request)
    {
        $validatedData = $request->validate([
            'card_number' => 'required|credit_card_number',
            'expire_year' => 'required|digits:4',
            'expire_month' => 'required|digits:2',
            'sec_code' => 'required|digits:3',
        ]);
        // Validate and process the user's credit card data from the request

        $cardTokenizationResponse = $this->fawaterk->createCardTokenization($validatedData);

        // Handle the $cardTokenizationResponse, which may contain the card token
        // You can store the card token in your database for future use
    }


//    public function index(){
//        $paymentMethods= $this->fawaterk->getPaymentmethods();
//        return view('fawaterk.index',compact('paymentMethods'));
//    }
//    public function executePayment(){
//        //send auth datails
//        //send cart items
//
//        $this->fawaterk->executePayment();
//    }
//    public function sendPayment(){
//        $this->fawaterk->sendPayment();
//    }


}
