<?php

return [
    // Epay WSDL Configurations
    'epay_merchant' => env('GMGATEWAY_EPAY_MERCHANT', ''),
    'epay_password' => env('GMGATEWAY_EPAY_PASSWORD', ''),

    // Economics WSDL Configurations
    'economics_token' => env('GMGATEWAY_ECONOMICS_TOKEN', ''),
    'economics_app_token' => env('GMGATEWAY_ECONOMICS_APP_TOKEN', ''),
];
