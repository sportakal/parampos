<?php

namespace Simpliers\Parampos\Requests\PreAuth;


use Simpliers\Parampos\Request\MakeRequest;
use Simpliers\Parampos\Requests\NonSecurePaymentInterface;
use Simpliers\Parampos\Requests\PaymentInterface;

class ClosePreAuthPayment implements NonSecurePaymentInterface
{

    use MakeRequest;

    protected $pre_auth_id;
    protected $pre_auth_amount;
    protected $order_id;

    private $transaction_hash;
    protected $wsdl = 'TP_Islem_Odeme_OnProv_Kapa';

    /**
     * @return string
     */
    public function getWsdl(): string
    {
        return $this->wsdl;
    }

    protected function makeHash(): string
    {
        return $this->transaction_hash = false;
    }

    /**
     * @return mixed
     */
    public function getPreAuthId()
    {
        return $this->pre_auth_id;
    }

    /**
     * @param mixed $order_id
     * @return ClosePreAuthPayment
     */
    public function setPreAuthId($pre_auth_id)
    {
        $this->pre_auth_id = $pre_auth_id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPreAuthAmount()
    {
        return $this->pre_auth_amount;
    }

    /**
     * @param mixed $order_id
     * @return ClosePreAuthPayment
     */
    public function setPreAuthAmount($pre_auth_amount)
    {
        $this->pre_auth_amount = $pre_auth_amount;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getOrderId()
    {
        return $this->order_id;
    }

    /**
     * @param mixed $order_id
     * @return ClosePreAuthPayment
     */
    public function setOrderId($order_id)
    {
        $this->order_id = $order_id;
        return $this;
    }


    /**
     * @inheritDoc
     */
    public function serialize()
    {
        $this->makeHash();
        return get_object_vars($this);
        // TODO: Implement jsonSerialize() method.
    }
}
