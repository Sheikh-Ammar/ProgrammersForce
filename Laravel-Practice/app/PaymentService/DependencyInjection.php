<?php

// ==================================================================== //
// =========================DEPENDENCY INJECTION======================= //
// ==================================================================== //


interface PaypalIntergation
{
    public function transactionDeatils();
}

class PaymentServive
{
    public function pay()
    {
        echo "PAYMENT SERVICE CLASS::PAY METHOD";
    }
}

class User implements PaypalIntergation
{
    // VARIBALE THAT ACCEPT PAYMENT CLASS
    public PaymentServive $service;


    // CONSTRUCTOR INJECTION
    public function __construct(PaymentServive $service)
    {
        $this->service = $service;
    }


    // SETTER METHOD INJECTION
    public function setService(PaymentServive $service)
    {
        $this->service = $service;
    }

    // INTERFACE INJECTION
    public function transactionDeatils()
    {
        echo "PAYPAL INTERFACE::TRANCATION DETAILS METHOD";
    }
}

$service = new PaymentServive();
$u = new User($service);


$u->service->pay();
echo "<br>";
$u->setService($service);
echo "<br>";
$u->transactionDeatils($service);
