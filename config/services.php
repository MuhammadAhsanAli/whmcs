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
        'scheme' => 'https',
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'remote_api' => [
        'crm' => env('CRM_API_BASE_URL', 'https://api.example.com'),
        'whm' => [
            'base_url' => env('WHM_API_BASE_URL', 'https://www.example.com/includes/api.php'),
            'secret' => env('WHM_SECRET', 'F1CKGXRIpylMfsrig3mwwdSdYUdLiFlo'),
            'identifier' => env('WHM_IDENTIFIER', 'D4j1dKYE3g40VROOPCGyJ9zRwP0ADJIv'),
        ],
    ],

];
