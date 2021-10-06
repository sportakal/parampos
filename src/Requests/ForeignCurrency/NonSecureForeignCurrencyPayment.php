<?php

namespace Simpliers\Parampos\Requests\ForeignCurrency;


use Simpliers\Parampos\Requests\NonSecurePaymentInterface;

class NonSecureForeignCurrencyPayment extends ForeignCurrencyModel implements NonSecurePaymentInterface
{
    protected $secure_type = 'NS';
}
