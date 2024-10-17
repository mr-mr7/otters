<?php

namespace App\Providers;

use App\Actions\Fortify\CreateNewUser;
use App\Actions\Fortify\ResetUserPassword;
use App\Actions\Fortify\UpdateUserPassword;
use App\Actions\Fortify\UpdateUserProfileInformation;
use App\Models\User;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Laravel\Fortify\Fortify;
use Laravel\Fortify\Http\Responses\LoginResponse;
use Laravel\Fortify\Http\Responses\RegisterResponse;

class FortifyServiceProvider extends ServiceProvider
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
        Fortify::createUsersUsing(CreateNewUser::class);
        Fortify::updateUserProfileInformationUsing(UpdateUserProfileInformation::class);
        Fortify::updateUserPasswordsUsing(UpdateUserPassword::class);
        Fortify::resetUserPasswordsUsing(ResetUserPassword::class);

        RateLimiter::for('login', function (Request $request) {
            $throttleKey = Str::transliterate(Str::lower($request->input(Fortify::username())) . '|' . $request->ip());

            return Limit::perMinute(5)->by($throttleKey);
        });

        RateLimiter::for('two-factor', function (Request $request) {
            return Limit::perMinute(5)->by($request->session()->get('login.id'));
        });

        $this->app->instance(LoginResponse::class, new class extends LoginResponse {
            public function toResponse($request)
            {
                return $request->wantsJson()
                    ? Response::success(data:[
                        'user' => $request->user(),
                        'token' => $request->user()->createToken('l')->plainTextToken
                    ])
                    : redirect()->intended(Fortify::redirects('login'));
            }
        });

        $this->app->instance(RegisterResponse::class, new class extends RegisterResponse {
            public function toResponse($request)
            {
                return $request->wantsJson()
                    ? Response::success(data:[
                        'user' => $request->user(),
                        'token' => $request->user()->createToken('l')->plainTextToken
                    ])
                    : redirect()->intended(Fortify::redirects('login'));
            }
        });
    }
}
