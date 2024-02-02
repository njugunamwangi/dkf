<?php

declare(strict_types=1);

return [
    'username' => env('AT_USERNAME', 'sandbox'),
    'api-key' => env('AT_KEY'),
    'sms' => [
        'from' => env('AT_FROM'),
    ],
    'payment' => [
        'product-name' => env('AFRICASTALKING_PAYMENT_PRODUCT'),
    ],
    'voice' => [
        'from' => env('AFRICASTALKING_VOICE_PHONE_NUMBER'),
    ]
];
