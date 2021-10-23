<?php


namespace Sportakal\Parampos\Requests;

use Sportakal\Parampos\Request\MakeRequest;

interface PaymentInterface
{
    public function setOrderId($order_id);

    public function getRawResult();

    public function serialize();
}