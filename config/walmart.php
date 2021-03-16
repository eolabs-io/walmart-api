<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Walmart ApI Keys
    |--------------------------------------------------------------------------
    |
    | Log into the portal to create your API key
    | Click My Account and select login type, either Marketplace or DSV.
    |
    */


    'client_id' => env('WALMART_API_CLIENT_ID'),

    'client_secret' => env('WALMART_API_CLIENT_SECRET'),

    'database' => [
        'connection' => env('DB_WM_CONNECTION'),
    ],

];
