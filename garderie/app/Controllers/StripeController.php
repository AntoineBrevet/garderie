<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class StripeController extends BaseController
{
    public function index()
    {
        return view('payment');
    }
        
    public function stripePayment()
    {
      require_once('application/libraries/stripe-php/init.php');
      $stripeSecret = 'sk_test_51KqedTGFqnMK1iszIFr79OxZ1CH2hUAFrL2t0yBcoLCJczQ34hu5Zr5wLltWLpOlvjIi7ebMiDH5WD2j0l9ejSc300Q95hDGvu';
 
        \Stripe\Stripe::setApiKey($stripeSecret);
      
        $stripe = \Stripe\Charge::create ([
                "amount" => $this->request->getVar('amount'),
                "currency" => "usd",
                "source" => $this->request->getVar('pk_test_51KqedTGFqnMK1isz6q448oTpoHKvWhFvKkGvSiTNow8iS3Awe8n0EJN5w0E47gkz6GeatHpZhWDuHNBy3l8BDPer00hxwyn4Se'),
                "description" => "You have just made the test payments."
        ]);
        // $stripeCustom = new \Stripe\StripeClient(
        //     'sk_test_51KqedTGFqnMK1iszIFr79OxZ1CH2hUAFrL2t0yBcoLCJczQ34hu5Zr5wLltWLpOlvjIi7ebMiDH5WD2j0l9ejSc300Q95hDGvu'
        //   );
        //   $stripeCustom->customers->create([
        //     'description' => 'My First Test Customer (created for API docs)',
        //   ]);
             
        $paymentData = array('success' => true, 'data'=> $stripe);
        
        echo '<pre>' , var_dump($paymentData) , '</pre>';

    }   
}
