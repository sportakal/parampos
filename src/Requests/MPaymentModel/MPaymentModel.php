<?php

namespace Simpliers\Parampos\Requests\MPaymentModel;


use Simpliers\Parampos\Request\MakeRequest;
use Simpliers\Parampos\Requests\PaymentInterface;

class MPaymentModel
{
    use MakeRequest;

    protected $card_holder;
    protected $card_number;
    protected $card_expiry_month;
    protected $card_expiry_year;
    protected $card_cvc;
    protected $card_owner_phone;
    protected $failure_url;
    protected $success_url;
    protected $order_id;
    protected $order_desciption;
    protected $installment_number;
    protected $transaction_amount;
    protected $total_amount;
    private $transaction_hash;
    protected $transaction_id;
    protected $ip_address;
    protected $ref_url;
    protected $data1;
    protected $data2;
    protected $data3;
    protected $data4;
    protected $data5;
    protected $data6;
    protected $data7;
    protected $data8;
    protected $data9;
    protected $data10;

    protected $wsdl = 'TP_WMD_UCD';

    /**
     * @return string
     */
    public function getWsdl(): string
    {
        return $this->wsdl;
    }

    protected function makeHash(): string
    {
        return $this->transaction_hash =
            $this->installment_number
            . $this->transaction_amount
            . $this->total_amount
            . $this->order_id;
    }

    /**
     * @return mixed
     */
    public function getCardHolder()
    {
        return $this->card_holder;
    }

    /**
     * @param mixed $card_number
     * @return MPaymentModel
     */
    public function setCardHolder($card_holder)
    {
        $this->card_holder = $card_holder;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCardNumber()
    {
        return $this->card_number;
    }

    /**
     * @param mixed $card_number
     * @return MPaymentModel
     */
    public function setCardNumber($card_number)
    {
        $this->card_number = $card_number;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCardExpiryMonth()
    {
        return $this->card_expiry_month;
    }

    /**
     * @param mixed $card_expiry_month
     * @return MPaymentModel
     */
    public function setCardExpiryMonth($card_expiry_month)
    {
        $this->card_expiry_month = $card_expiry_month;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCardExpiryYear()
    {
        return $this->card_expiry_year;
    }

    /**
     * @param mixed $card_expiry_year
     * @return MPaymentModel
     */
    public function setCardExpiryYear($card_expiry_year)
    {
        $this->card_expiry_year = $card_expiry_year;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCardCvc()
    {
        return $this->card_cvc;
    }

    /**
     * @param mixed $card_cvc
     * @return MPaymentModel
     */
    public function setCardCvc($card_cvc)
    {
        $this->card_cvc = $card_cvc;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCardOwnerPhone()
    {
        return $this->card_owner_phone;
    }

    /**
     * @param mixed $card_owner_phone
     * @return MPaymentModel
     */
    public function setCardOwnerPhone($card_owner_phone)
    {
        $this->card_owner_phone = $card_owner_phone;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getSuccessUrl()
    {
        return $this->success_url;
    }

    /**
     * @param mixed $success_url
     * @return MPaymentModel
     */
    public function setSuccessUrl($success_url)
    {
        $this->success_url = $success_url;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getFailureUrl()
    {
        return $this->failure_url;
    }

    /**
     * @param mixed $failure_url
     * @return MPaymentModel
     */
    public function setFailureUrl($failure_url)
    {
        $this->failure_url = $failure_url;
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
     * @return MPaymentModel
     */
    public function setOrderId($order_id)
    {
        $this->order_id = $order_id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getOrderDesciption()
    {
        return $this->order_desciption;
    }

    /**
     * @param mixed $order_desciption
     * @return MPaymentModel
     */
    public function setOrderDesciption($order_desciption)
    {
        $this->order_desciption = $order_desciption;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getInstallmentNumber()
    {
        return $this->installment_number;
    }

    /**
     * @param mixed $installment_number
     * @return MPaymentModel
     */
    public function setInstallmentNumber($installment_number)
    {
        $this->installment_number = $installment_number;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTransactionAmount()
    {
        return $this->transaction_amount;
    }

    /**
     * @param mixed $transaction_amount
     * @return MPaymentModel
     */
    public function setTransactionAmount($transaction_amount)
    {
        $this->transaction_amount = $transaction_amount;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTotalAmount()
    {
        return $this->total_amount;
    }

    /**
     * @param mixed $total_amount
     * @return MPaymentModel
     */
    public function setTotalAmount($total_amount)
    {
        $this->total_amount = $total_amount;
        return $this;
    }

    /**
     * @return string
     */
    public function getSecureType(): string
    {
        return $this->secure_type;
    }

    /**
     * @param string $secure_type
     * @return MPaymentModel
     */
    public function setSecureType(string $secure_type): MPaymentModel
    {
        $this->secure_type = $secure_type;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTransactionId()
    {
        return $this->transaction_id;
    }

    /**
     * @param mixed $transaction_id
     * @return MPaymentModel
     */
    public function setTransactionId($transaction_id)
    {
        $this->transaction_id = $transaction_id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getIpAddress()
    {
        return $this->ip_address;
    }

    /**
     * @param mixed $ip_address
     * @return MPaymentModel
     */
    public function setIpAddress($ip_address)
    {
        $this->ip_address = $ip_address;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getRefUrl()
    {
        return $this->ref_url;
    }

    /**
     * @param mixed $ref_url
     * @return MPaymentModel
     */
    public function setRefUrl($ref_url)
    {
        $this->ref_url = $ref_url;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getData1()
    {
        return $this->data1;
    }

    /**
     * @param mixed $data1
     * @return MPaymentModel
     */
    public function setData1($data1)
    {
        $this->data1 = $data1;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getData2()
    {
        return $this->data2;
    }

    /**
     * @param mixed $data2
     * @return MPaymentModel
     */
    public function setData2($data2)
    {
        $this->data2 = $data2;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getData3()
    {
        return $this->data3;
    }

    /**
     * @param mixed $data3
     * @return MPaymentModel
     */
    public function setData3($data3)
    {
        $this->data3 = $data3;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getData4()
    {
        return $this->data4;
    }

    /**
     * @param mixed $data4
     * @return MPaymentModel
     */
    public function setData4($data4)
    {
        $this->data4 = $data4;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getData5()
    {
        return $this->data5;
    }

    /**
     * @param mixed $data5
     * @return MPaymentModel
     */
    public function setData5($data5)
    {
        $this->data5 = $data5;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getData6()
    {
        return $this->data6;
    }

    /**
     * @param mixed $data6
     * @return MPaymentModel
     */
    public function setData6($data6)
    {
        $this->data6 = $data6;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getData7()
    {
        return $this->data7;
    }

    /**
     * @param mixed $data7
     * @return MPaymentModel
     */
    public function setData7($data7)
    {
        $this->data7 = $data7;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getData8()
    {
        return $this->data8;
    }

    /**
     * @param mixed $data8
     * @return MPaymentModel
     */
    public function setData8($data8)
    {
        $this->data8 = $data8;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getData9()
    {
        return $this->data9;
    }

    /**
     * @param mixed $data9
     * @return MPaymentModel
     */
    public function setData9($data9)
    {
        $this->data9 = $data9;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getData10()
    {
        return $this->data10;
    }

    /**
     * @param mixed $data10
     * @return MPaymentModel
     */
    public function setData10($data10)
    {
        $this->data10 = $data10;
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