<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],
    
    // 'google' => [
    //     'client_id' => '190288791081-i29l09hpmp9o7hgevlr8kgroimckl665.apps.googleusercontent.com',
    //     'client_secret' => '48YCLh9NUOYA4mjPaNq-J_Pp',
    //     'redirect' => 'https://mixer.appcrates.co/public/auth/google/callback',
    // ],
    
    'facebook' => [

        'client_id' => '793522431472820',
        'client_secret' => 'a749eb7845d1e78e5e91874e96d9a3d5',
        'redirect' => 'https://mixer.appcrates.co/auth/facebook/callback',

    ],

];
