<?php

namespace Simpliers\Parampos\Requests\PreAuth;


use Simpliers\Parampos\Requests\PreAuth\PreAuthPaymentModel;
use Simpliers\Parampos\Requests\SecurePaymentInterface;

class SecurePreAuthPayment extends PreAuthPaymentModel implements SecurePaymentInterface
{
    protected $secure_type = '3D';
}
