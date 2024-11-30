<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Barangay;
use Illuminate\Support\Facades\Auth;


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
        $barangays = Barangay::all();
        View::share('barangays', $barangays);

        // Share the currently authenticated user's barangay if applicable
        View::composer('*', function ($view) {
            if (Auth::check()) {
                $barangay = Barangay::find(Auth::user()->barangay_id); // Adjust according to your user structure
                $view->with('barangay', $barangay);
            }
        });
    }
}
