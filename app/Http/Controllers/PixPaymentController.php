<?php

namespace App\Http\Controllers;

use Junges\Pix\Pix;
use Illuminate\Http\Request;

class PixPaymentController extends Controller
{
  
    
    public function createPayment(Request $request, Pix $pix)
    {
        // Define your payment details
        $paymentDetails = [
            'description' => 'Payment for your order',
            'amount' => 100.00, // Adjust the amount
            'merchantName' => 'Your Business Name',
            'merchantCity' => 'Your City',
        ];
    
        // Create a PIX payment request
        $payment = $pix->createPayment($paymentDetails);
    
        // Redirect the user to the PIX payment page
        return redirect($payment->getQrCode()->getQrCodeString());
    }
}
