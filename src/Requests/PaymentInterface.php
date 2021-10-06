<?php


namespace Simpliers\Parampos\Requests;

use Simpliers\Parampos\Request\MakeRequest;

interface PaymentInterface
{
    public function setOrderId($order_id);

    public function getRawResult();

    public function serialize();
}