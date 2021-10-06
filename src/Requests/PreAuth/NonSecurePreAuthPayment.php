<?php

namespace Simpliers\Parampos\RequestModels;

use Simpliers\Parampos\Requests\PreAuth\PreAuthPaymentModel;
use Simpliers\Parampos\Requests\SecurePaymentInterface;

class NonSecurePreAuthPayment extends PreAuthPaymentModel implements SecurePaymentInterface
{
    protected $secure_type = 'NS';

}
