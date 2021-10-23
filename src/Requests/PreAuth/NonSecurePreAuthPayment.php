<?php

namespace Sportakal\Parampos\Requests\PreAuth;

use Sportakal\Parampos\Requests\PreAuth\PreAuthPaymentModel;
use Sportakal\Parampos\Requests\SecurePaymentInterface;

class NonSecurePreAuthPayment extends PreAuthPaymentModel implements SecurePaymentInterface
{
    protected $secure_type = 'NS';

}
