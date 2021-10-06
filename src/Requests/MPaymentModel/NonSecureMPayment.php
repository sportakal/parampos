<?php

namespace Simpliers\Parampos\Requests\MPaymentModel;


use Simpliers\Parampos\Requests\NonSecurePaymentInterface;

class NonSecureMPayment extends MPaymentModel implements NonSecurePaymentInterface
{
    protected $secure_type = 'NS';

}
