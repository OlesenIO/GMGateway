<?php

namespace OlesenIO\GMGateway\Economics\Format;

class Product
{
    public $id;
    public $title;
    public $price;
    public $amount;
    public function __construct($id, $title, $price, $amount)
    {
        $this->id = $id;
        $this->title = $title;
        $this->price = $price;
        $this->amount = $amount;
    }
}
