<?php


namespace Simpliers\Parampos\Responses;

use DOMDocument;
use DOMElement;
use Http;
use Illuminate\Database\Eloquent\Model;
use phpDocumentor\Reflection\Location;
use PhpParser\Builder\Class_;
use Simpliers\Parampos\Exception\ParamposException;
use Simpliers\Parampos\Models\ParamposLog;
use Simpliers\Parampos\Requests\SecurePaymentInterface;

class CallbackSecureResponse extends ResponseModel
{

    protected $md;
    protected $mdStatus;
    protected $orderId;
    protected $transactionAmount;
    protected $transactionGUID;
    protected $transactionHash;

    public function __construct(array $payment_result)
    {
        parent::__construct($payment_result);

        $this->md = $this->raw_result['md'] ?? null;
        $this->mdStatus = $this->raw_result['mdStatus'] ?? null;
        $this->orderId = $this->raw_result['orderId'] ?? null;
        $this->transactionAmount = $this->raw_result['transactionAmount'] ?? null;
        $this->transactionGUID = $this->raw_result['islemGUID'] ?? null;
        $this->transactionHash = $this->raw_result['islemHash'] ?? null;

        if (true) {
            $this->addLog();
        }
    }

    /**
     * @returns bool
     */
    public function getMdStatus()
    {
        if (in_array($this->mdStatus, [1, 2, 3, 4])) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * @returns bool
     */
    public function getMdStatusCode()
    {
        return $this->mdStatus;
    }

    public function getStatusMessage()
    {
        $status_messages = [
            0 => "3-D Secure imzası geçersiz veya doğrulama",
//            2 => "Kart sahibi veya bankası sisteme kayıtlı değil",
//            3 => "Kartın bankası sisteme kayıtlı değil",
//            4 => "Doğrulama denemesi, kart sahibi sisteme daha sonra kayıt olmayı seçmiş",
            5 => "Doğrulama yapılamıyor",
            6 => "3-D Secure hatası",
            7 => "Sistem hatası",
            8 => "Bilinmeyen kart no"
        ];
        return $status_messages[$this->getMdStatusCode()] ?? null;
    }

    public function getPreAuthTransactionGUID()
    {
        return $this->transactionGUID ?? null;
    }

    /**
     * @inheritDoc
     */
    public function serialize()
    {
        return get_object_vars($this);
    }

    private function addLog()
    {
        $parampos_log = ParamposLog::where('order_id', $this->orderId)->first();
        if ($parampos_log) {
            $parampos_log->md_status = $this->getMdStatus();
            $parampos_log->md_status_code = $this->getMdStatusCode();
            $parampos_log->md_status_text = $this->getStatusMessage();
            $parampos_log->pre_auth_id = $this->getPreAuthTransactionGUID();
            $parampos_log->save();
            if ($parampos_log) {
                $this->parampos_log = $parampos_log;
            }
        }
    }
}