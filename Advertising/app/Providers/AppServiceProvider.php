<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use App\Models\Pemesanan;
use App\Models\Pembayaran;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
       View::composer('*', function ($view) {
            $notifCount = 0;
            $invoiceNotifCount = 0;
    
            if (Auth::check()) {
                $user = Auth::user();
    
                if ($user->role === 'a') {
                    $notifCount = Pemesanan::where('status', 'menunggu')->count();
                    $invoiceNotifCount = Pembayaran::where('status_verifikasi', 'pending')->count();
                }
            }
    
            $view->with([
                'notifCount' => $notifCount,
                'invoiceNotifCount' => $invoiceNotifCount,
            ]);
        });
    }
}
