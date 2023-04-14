<?php

return [
    'key' => env('PAY_KEY'),
    'purchase' => 'https://api.idpay.ir/v1.1/payment',
    'complete' => 'https://api.idpay.ir/v1.1/payment/verify',
    'sandbox' => false
];
