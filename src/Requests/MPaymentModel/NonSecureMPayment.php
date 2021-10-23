<?php

namespace Sportakal\Parampos\Requests\MPaymentModel;


use Sportakal\Parampos\Requests\NonSecurePaymentInterface;

class NonSecureMPayment extends MPaymentModel implements NonSecurePaymentInterface
{
    protected $secure_type = 'NS';

}
