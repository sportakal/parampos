<?php

namespace Sportakal\Parampos\Requests\MPaymentModel;


use Sportakal\Parampos\Requests\NonSecurePaymentInterface;

class SecureMPayment extends MPaymentModel implements NonSecurePaymentInterface
{
    protected $secure_type = '3D';

}
