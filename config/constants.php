<?php

return [
    'FCM_API_KEY'               =>  env('FCM_API_KEY'),
    'FCM_SENDER_ID'             =>  env('FCM_SENDER_ID'),
    'AUTH_DOMAIN'               =>  env('AUTH_DOMAIN'),
    'DEFAULT_CURRENCY_CODE'     =>  env('CAMPAIGN_CURRENCY_CODE'),
    'DEFAULT_CURRENCY_SYMBOL'   =>  env('CAMPAIGN_CURRENCY_SYMBOL'),
    'DEFAULT_INITIAL_PRICE'     =>  env('CAMPAIGN_INITIAL_PRICE'),
    'DEFAULT_EXTRA_PRICE'       =>  env('CAMPAIGN_EXTRA_PRICE'),
    'stripe_pk_key'             => env('STRIPE_SECRET', null),

];