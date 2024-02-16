<?php

    namespace App\Enums;

    enum PaymentType: string {
        case MUTATION = 'Mutation';
        case REGISTRATION = 'Registration';
        case SHARES = 'Shares';
    }