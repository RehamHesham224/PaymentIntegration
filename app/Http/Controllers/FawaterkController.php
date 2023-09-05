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

    public function index(){
        $paymentMethods= $this->fawaterk->getPaymentmethods();
        return view('fawaterk.index',compact('paymentMethods'));
    }
    public function executePayment(){
        //send auth datails
        //send cart items

        $this->fawaterk->executePayment();
    }
    public function sendPayment(){
        $this->fawaterk->sendPayment();
    }


}
