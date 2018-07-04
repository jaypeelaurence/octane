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

        //Validates MobileNumber
        Validator::extend('mobile', function ($attribute, $value, $parameters){
            if(strlen($value) != 12 || substr($value, 0, 2) != '63' || is_numeric($value) == false){
                return false;
            }else{
                return true;
            }
        }, 'The mobile number must be a valid.');
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
