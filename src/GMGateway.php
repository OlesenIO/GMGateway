<?php

namespace OlesenIO\GMGateway;

use OlesenIO\GMGateway\Economics\Format\Product;
use OlesenIO\GMGateway\Economics\Webservice as EconomicsWebservice;
use OlesenIO\GMGateway\EPay\Webservice as EPayWebservice;

class GMGateway
{
    public static function epay()
    {
        return new EPayWebservice;
    }

    public static function invoice()
    {
        return new EconomicsWebservice;
    }

    public static function economic()
    {
        return new Restapi;
    }

    public static function createProductLine($product)
    {
        return new Product($product['id'], $product['name'], $product['price'], $product['amount']);
    }
}
