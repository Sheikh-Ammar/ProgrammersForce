<?php

namespace App\PaymentService;


class PaypalAPI implements Easypaisa
{
    public $transactionId;

    // GET THORUGH SERVICE PROVIDER
    public function __construct($transactionId)
    {
        $this->transactionId = $transactionId;
    }

    public function getPayment(): string
    {
        return  "Bill payed through Paypal";
    }

    public function paymentDetails(): array
    {
        return [
            'status' => "Bill payed through Paypal",
            'amount' => 10000,
            'transactionId' => $this->transactionId,
        ];
    }

    public function checkout()
    {
        echo "Easypaisa Interface:: Checkout Method";
    }
}
