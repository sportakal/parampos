<?php

namespace Sportakal\Parampos\Requests\PreAuth;


use Sportakal\Parampos\Requests\PreAuth\PreAuthPaymentModel;
use Sportakal\Parampos\Requests\SecurePaymentInterface;

class SecurePreAuthPayment extends PreAuthPaymentModel implements SecurePaymentInterface
{
    protected $secure_type = '3D';
}
