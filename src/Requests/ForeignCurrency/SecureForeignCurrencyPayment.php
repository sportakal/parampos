<?php

namespace Sportakal\Parampos\Requests\ForeignCurrency;


use Sportakal\Parampos\Requests\SecurePaymentInterface;

class SecureForeignCurrencyPayment extends ForeignCurrencyModel implements SecurePaymentInterface
{
    protected $secure_type = '3D';
}
