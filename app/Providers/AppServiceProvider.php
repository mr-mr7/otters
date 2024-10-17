<?php

namespace App\Providers;

use Illuminate\Support\Facades\Response;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        Response::macro('success', function ($message = null, $data = [], $code = 200) {
            return response([
                'message' => $message ?? 'عملیات با موفقیت انجام شد',
                'data' => $data
            ], $code);
        });

        Response::macro('error', function ($message = null, $errors = [], $code = 400) {
            return response([
                'message' => $message ?? 'عملیات با خطا مواجه شده است',
                'errors' => $errors
            ], $code);
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
