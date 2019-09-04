<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Authentication Defaults
    |--------------------------------------------------------------------------
    |
    | This option controls the default authentication "guard" and password
    | reset options for your application. You may change these defaults
    | as required, but they're a perfect start for most applications.
    |
    */

    'defaults' => [
        'guard' => 'web',
        'passwords' => 'users',
    ],

    /*
    |--------------------------------------------------------------------------
    | Authentication Guards
    |--------------------------------------------------------------------------
    |
    | Next, you may define every authentication guard for your application.
    | Of course, a great default configuration has been defined for you
    | here which uses session storage and the Eloquent user provider.
    |
    | All authentication drivers have a user provider. This defines how the
    | users are actually retrieved out of your database or other storage
    | mechanisms used by this application to persist your user's data.
    |
    | Supported: "session", "token"
    |
    */

    'guards' => [
        'web' => [
            'driver' => 'session',
            'provider' => 'users',
        ],
        'api' => [
            'driver' => 'token',
            'provider' => 'users',
            'hash' => false,
        ],
        'admin'=>[
            'driver'=>'session',
            'provider'=>'admins'
        ],
        'admins-api' => [
            'driver' => 'token',
            'provider' => 'admins',
        ],
        'patient'=>[
            'driver'=>'session',
            'provider'=>'patients'
        ],
        'patients-api' => [
            'driver' => 'token',
            'provider' => 'patients',
            //'hash' => false,
        ],
        'doctor'=>[
            'driver'=>'session',
            'provider'=>'doctors'
        ],
        'doctors-api' => [
            'driver' => 'token',
            'provider' => 'doctors',
            //'hash' => false,
        ],
        'staff'=>[
            'driver'=>'session',
            'provider'=>'staffs',
            //hash = > false
        ],
        'staff-api' => [
            'driver' => 'token',
            'provider' => 'staffs',
            //'hash' => false
        ],
        'nurse'=>[
            'driver'=>'session',
            'provider'=>'nurses'
            //hash => false
        ],
        'nurses-api' => [
            'driver' => 'token',
            'provider' => 'nurses',
           // 'hash' => false,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | User Providers
    |--------------------------------------------------------------------------
    |
    | All authentication drivers have a user provider. This defines how the
    | users are actually retrieved out of your database or other storage
    | mechanisms used by this application to persist your user's data.
    |
    | If you have multiple user tables or models you may configure multiple
    | sources which represent each model / table. These sources may then
    | be assigned to any extra authentication guards you have defined.
    |
    | Supported: "database", "eloquent"
    |
    */

    'providers' => [
        'users' => [
            'driver' => 'eloquent',
            'model' => App\User::class,
        ],

        // 'users' => [
        //     'driver' => 'database',
        //     'table' => 'users',
        // ],
        'admins'=>[
            'driver'=>'eloquent',
            'model'=>App\Admin::class
        ],
        'doctors'=>[
            'driver'=>'eloquent',
            'model'=>App\Doctors::class
        ],
        'patients'=>[
            'driver'=>'eloquent',
            'model'=>App\Patients::class
        ],
        'nurses'=>[
            'driver'=>'eloquent',
            'model'=>App\Nurse::class
        ],
        'staffs'=>[
            'driver'=>'eloquent',
            'model'=>App\Staff::class
        ]
    ],

    /*
    |--------------------------------------------------------------------------
    | Resetting Passwords
    |--------------------------------------------------------------------------
    |
    | You may specify multiple password reset configurations if you have more
    | than one user table or model in the application and you want to have
    | separate password reset settings based on the specific user types.
    |
    | The expire time is the number of minutes that the reset token should be
    | considered valid. This security feature keeps tokens short-lived so
    | they have less time to be guessed. You may change this as needed.
    |
    */

    'passwords' => [
        'users' => [
            'provider' => 'users',
            'table' => 'password_resets',
            'expire' => 60,
        ],
        'admins'=>[
            'provider'=>'admins',
            'table=>'=>'password_resets',
            'expire'=>15
        ],
        'patients'=>[
            'provider'=>'patients',
            'table'=>'password_resets',
            'expire'=>15
        ],
        'doctors'=>[
            'provider'=>'doctors',
            'table'=>'password_resets',
            'expire'=>15
        ],
        'nurses'=>[
            'provider'=>'nurses',
            'table'=>'password_resets',
            'expire'=>15
        ],
        'staffs'=>[
            'provider'=>'staffs',
            'table'=>'password_resets',
            'expire'=>15
        ]
        
    ],

];
