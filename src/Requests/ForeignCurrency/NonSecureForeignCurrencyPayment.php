<?php

namespace Sportakal\Parampos\Requests\ForeignCurrency;


use Sportakal\Parampos\Requests\NonSecurePaymentInterface;

class NonSecureForeignCurrencyPayment extends ForeignCurrencyModel implements NonSecurePaymentInterface
{
    protected $secure_type = 'NS';
}
