<?php

namespace OlesenIO\GMGateway;

use OlesenIO\GMGateway\EPay\Webservice;

class GMGateway
{
    protected $epay;

    public function __construct()
    {
        $this->epay = new Webservice;
    }
}
