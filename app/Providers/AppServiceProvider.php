<?php

namespace App\Providers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Validator::extend('checkCurrentPasswordHashed', function ($attribute, $value, $parameters) {
            if (!Hash::check($value, $parameters[0])) {
                return false;
            }
            return true;
        });

        Validator::replacer('checkCurrentPasswordHashed', function ($attribute, $value, $rule, $parameters) {
            return 'The current password you entered did not match';
        });
    }
}