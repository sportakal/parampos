<?php

namespace Simpliers\Parampos\Requests\ForeignCurrency;


use Simpliers\Parampos\Requests\SecurePaymentInterface;

class SecureForeignCurrencyPayment extends ForeignCurrencyModel implements SecurePaymentInterface
{
    protected $secure_type = '3D';
}
