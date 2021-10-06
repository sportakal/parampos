<?php

namespace Simpliers\Parampos\Requests\MPaymentModel;


use Simpliers\Parampos\Requests\NonSecurePaymentInterface;

class SecureMPayment extends MPaymentModel implements NonSecurePaymentInterface
{
    protected $secure_type = '3D';

}
