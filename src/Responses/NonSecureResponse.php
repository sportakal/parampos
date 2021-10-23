<?php


namespace Sportakal\Parampos\Responses;

use DOMDocument;
use DOMElement;
use Sportakal\Parampos\Exception\ParamposException;
use Sportakal\Parampos\Requests\NonSecurePaymentInterface;

class NonSecureResponse extends ResponseModel
{
    public function __construct(NonSecurePaymentInterface $payment_result)
    {
        parent::__construct($payment_result);
    }

}