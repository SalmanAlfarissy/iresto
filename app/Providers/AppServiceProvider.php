<?php

namespace App\Providers;

use App\Repositories\ContractRepository;
use App\Repositories\Debet\DebetRepository;
use App\Repositories\Kredit\KreditRepository;
use App\Repositories\Transaction\TransactionRepository;
use App\Repositories\User\UserRepository;
use App\Services\ContractPayment;
use App\Services\Payment\MidtransPaymentGateway;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(ContractRepository::class, function($app){
            if (preg_match("/transaction/", request()->url())) {
                return $app->make(TransactionRepository::class);
            }elseif (preg_match("/user/", request()->url())) {
                return $app->make(UserRepository::class);
            }elseif (preg_match("/kredit/", request()->url())) {
                return $app->make(KreditRepository::class);
            }elseif (preg_match("/debet/", request()->url())) {
                return $app->make(DebetRepository::class);
            }
        });

        $this->app->bind(ContractPayment::class, function($app){
            return $app->make(MidtransPaymentGateway::class);
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
