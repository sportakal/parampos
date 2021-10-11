<?php

namespace Simpliers\Parampos\Requests\CompleteSecurePayment;

use Simpliers\Parampos\Config\Config;
use Simpliers\Parampos\Request\MakeRequest;
use Simpliers\Parampos\Responses\CallbackSecureResponse;
use Simpliers\Parampos\Responses\ResponseModel;

class CompleteSecurePaymentModel
{
    use MakeRequest;

    protected $wsdl = 'TP_WMD_Pay';

    protected $raw_result;
    protected $callbackSecureResponse;

    public function __construct(CallbackSecureResponse $callbackSecureResponse)
    {
        $this->callbackSecureResponse = $callbackSecureResponse;

    }

    public function make()
    {
        $callbackSecureResponse_array = $this->callbackSecureResponse->serialize();

        $post_fields = [
            'UCD_MD' => $callbackSecureResponse_array['md'],
            'Islem_GUID' => $callbackSecureResponse_array['transactionGUID'],
            'Siparis_ID' => $callbackSecureResponse_array['orderId'],
        ];

        $xml = $this->makeXML($this->wsdl, $post_fields);
        $response_xml = $this->curl($xml, $this->wsdl);

        $response = self::parseXML($response_xml);
        $this->raw_result = $response;


        if (true) {
            //TODO connect savelog variable in Config
            $this->saveLog($this->callbackSecureResponse);
        }

        return $this->raw_result;
    }

    private function getCompleteStatusCode()
    {
        return $this->raw_result['Sonuc'] ?? null;
    }

    /**
     * @return array
     */
    public function getCompleteRawResult()
    {
        return $this->raw_result;
    }

    /**
     * @return bool
     */
    public function getCompleteStatus()
    {
        return $this->getCompleteStatusCode() == 1 && $this->getCompleteInvoiceID() !== '0';
    }

    /**
     * @return string
     */
    public function getCompleteMessage()
    {
        return $this->raw_result['Sonuc_Ack'] ?? null;
    }

    /**
     * @return mixed|string
     */
    public function getCompleteOrderID()
    {
        return $this->raw_result['Siparis_ID'] ?? null;
    }


    /**
     * @return mixed|string
     */
    public function getCompleteInvoiceID()
    {
        return $this->raw_result['Dekont_ID'] ?? null;
    }

    /**
     * @return mixed|string
     */
    public function getCompleteBankTransactionID()
    {
        return $this->raw_result['Bank_Trans_ID'] ?? null;
    }

    /**
     * @return mixed|string
     */
    public function getCompleteBankHostMessage()
    {
        return $this->raw_result['Bank_HostMsg'] ?? null;
    }

    /**
     * @returns array
     */
    public function getBankExtras()
    {
        $bank_extra_xml = $this->raw_result['Bank_Extra'] ?? false;
        if ($bank_extra_xml) {
            $bank_extras = self::parseXML($bank_extra_xml);
        } else {
            $bank_extras = [];
        }
        return $bank_extras;
    }

    /**
     * @inheritDoc
     */
    public function serialize()
    {
        return get_object_vars($this);
        // TODO: Implement jsonSerialize() method.
    }

    private function saveLog($callbackSecureResponse)
    {
        $parampos_log = $callbackSecureResponse->getParamposLog();
        $parampos_log->status = $this->getCompleteStatus();
        $parampos_log->status_code = $this->getCompleteStatusCode();
        $parampos_log->status_text = $this->getCompleteMessage();

        $parampos_log->invoice_id = $this->getCompleteInvoiceID();
        $parampos_log->bank_transaction_id = $this->getCompleteBankTransactionID();
        $parampos_log->bank_extra = json_encode($this->getBankExtras());
        $parampos_log->save();
    }
}