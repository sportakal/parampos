<?php


namespace Simpliers\Parampos\Responses;

use DOMDocument;
use DOMElement;
use Simpliers\Parampos\Exception\ParamposException;
use Simpliers\Parampos\Requests\NonSecurePaymentInterface;

class NonSecureResponse extends ResponseModel
{
    public function __construct(NonSecurePaymentInterface $payment_result)
    {
        parent::__construct($payment_result);
    }

}