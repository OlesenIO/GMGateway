<?php

return [
    'client' => env('GMGATEWAY_EPAY_CLIENT', 'https://ssl.ditonlinebetalingssystem.dk/remote/payment.asmx?WSDL'),
    'merchant' => env('GMGATEWAY_EPAY_MERCHANT', ''),
    'password' => env('GMGATEWAY_EPAY_PASSWORD', ''),
];
