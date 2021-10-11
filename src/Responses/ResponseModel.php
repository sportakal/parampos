<?php


namespace Simpliers\Parampos\Responses;


use Illuminate\Database\Eloquent\Model;
use Simpliers\Parampos\Models\ParamposLog;
use Simpliers\Parampos\Requests\PaymentInterface;
use Simpliers\Parampos\Requests\SecurePaymentInterface;

class ResponseModel
{
    protected $raw_result;


    protected $parampos_log;

    /**
     * @return ParamposLog
     */
    public function getParamposLog(): ParamposLog
    {
        return $this->parampos_log;
    }

    public function __construct($payment_result)
    {
        if ($payment_result instanceof PaymentInterface) {
            $this->raw_result = $payment_result->getRawResult();

            if (true) {
                //TODO connect savelog variable in Config
                $this->saveLog($payment_result);
            }
        } else {
            $this->raw_result = $payment_result;
        }
    }


    /**
     * @return int
     */
    public function getPreAuthId()
    {
        return $this->raw_result['Islem_GUID'] ?? null;
    }

    /**
     * @return int
     */
    public function getOrderId()
    {
        return $this->raw_result['Siparis_ID'] ?? null;
    }

    /**
     * @return int
     */
    public function getStatusCode()
    {
        return $this->raw_result['Sonuc'] ?? null;
    }

    /**
     * @return bool
     */
    public function getStatus()
    {
        return ($this->raw_result['Sonuc'] ?? null) == 1;
    }

    public function getTransactionID()
    {
        return $this->raw_result['Islem_ID'] ?? null;
    }

    public function getResultText()
    {
        return $this->raw_result['Sonuc_Str'] ?? null;
    }

    public function getBankTransactionID()
    {
        return $this->raw_result['Banka_Sonuc_Kod'] ?? null;
    }

    public function getBankResultCode()
    {
        return $this->raw_result['Banka_Sonuc_Kod'] ?? null;
    }

    /**
     * @return mixed
     */
    public function getRawResult()
    {
        return $this->raw_result;
    }

    private function saveLog($payment_result)
    {
        $serialize_payment_result = $payment_result->serialize();

        $classes = explode("\\", get_class($payment_result));
        $transaction_type = end($classes);

        $order_id = $serialize_payment_result['order_id'];
        $card_number = $serialize_payment_result['card_number'] ?? null;
        $first_num = substr($card_number, 0, 4);
        $last_num = substr($card_number, -2);
        $card_number = $first_num . "**" . $last_num;

        $installment_number = $serialize_payment_result['installment_number'] ?? null;
        $transaction_amount = $serialize_payment_result['transaction_amount'] ?? null;
        $total_amount = $serialize_payment_result['total_amount'] ?? null;
        $secure_type = $serialize_payment_result['secure_type'] ?? null;
        $reference_url = $serialize_payment_result['reference_url'] ?? null;
        $ip_address = $serialize_payment_result['ip_address'] ?? null;
        $pre_auth_id = $serialize_payment_result['pre_auth_id'] ?? $this->getPreAuthId();

        $transaction_id = $this->getTransactionID();
        $bank_transaction_id = $this->getBankTransactionID();
        $status = $this->getStatus();
        $status_code = $this->getStatusCode();
        $status_text = $this->getResultText();

        $parampos_log = new ParamposLog();
        $parampos_log->user_id = auth()->check() ? auth()->user()->id : null;
        $parampos_log->transaction_type = $transaction_type;
        $parampos_log->order_id = $order_id;
        $parampos_log->card_number = $card_number ?? null;
        $parampos_log->installment_number = $installment_number;
        $parampos_log->transaction_amount = $transaction_amount;
        $parampos_log->total_amount = $total_amount;
        $parampos_log->secure_type = $secure_type;
        $parampos_log->reference_url = $reference_url;
        $parampos_log->ip_address = $ip_address;
        $parampos_log->transaction_id = $transaction_id;
        $parampos_log->status = $status;
        $parampos_log->status_code = $status_code;
        $parampos_log->status_text = $status_text;
        $parampos_log->bank_transaction_id = $bank_transaction_id;
        $parampos_log->pre_auth_id = $pre_auth_id;

        $parampos_log->save();

        $this->parampos_log = $parampos_log;
    }
}