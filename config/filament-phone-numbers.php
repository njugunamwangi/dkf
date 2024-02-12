<?php

// config for Cheesegrits/FilamentPhoneNumbers
use Brick\PhoneNumber\PhoneNumberFormat;

return [
    'defaults' => [
        'region' => env('FILAMENT_PHONE_NUMBERS_ISO_COUNTRY', 'KE'),
        'database_format' => env('FILAMENT_PHONE_NUMBERS_DATABASE_FORMAT', PhoneNumberFormat::INTERNATIONAL),
        'display_format' => env('FILAMENT_PHONE_NUMBERS_DISPLAY_FORMAT', PhoneNumberFormat::INTERNATIONAL),
        'icon' => env('FILAMENT_PHONE_NUMBERS_ICON', 'heroicon-m-phone'),
    ],
];
