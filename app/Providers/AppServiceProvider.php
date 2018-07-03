<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //Validates ChangePassword
        Validator::extend('checkPass', function ($attribute, $value, $parameters){
            if(md5($value) != $parameters[0]){
                return false;
            }else{
                return true;
            }
        }, 'The old password field is incorrect.');
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
