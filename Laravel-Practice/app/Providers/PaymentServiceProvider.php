<?php

namespace App\Providers;

use App\PaymentService\PaypalAPI;
use Illuminate\Support\ServiceProvider;

class PaymentServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        // $this->app->bind(PaypalAPI::class, function () {
        //     return new PaypalAPI(rand(1, 50));
        // });

        $paypal = new PaypalAPI(rand(1, 50));
        $this->app->instance(PaypalAPI::class, $paypal);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
