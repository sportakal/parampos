<?php


namespace Sportakal\Parampos\Responses;

use DOMDocument;
use DOMElement;
use Http;
use phpDocumentor\Reflection\Location;
use PhpParser\Builder\Class_;
use Sportakal\Parampos\Exception\ParamposException;
use Sportakal\Parampos\Requests\SecurePaymentInterface;

class SecureResponse extends ResponseModel
{

    public function getResultText()
    {
        $text = $this->raw_result['Sonuc_Str'] ?? null;
        if ($this->getStatus()) {
            $text .= ' - 3DS Ekranına Yönlendirildi';
        }
        return $text;
    }

    public function getPreAuthTransactionGUID()
    {
        return $this->raw_result['Islem_GUID'] ?? null;
    }

    public function getThreeDUrl()
    {
        return $this->raw_result['UCD_URL'] ?? null;
    }

    public function getThreeDContent()
    {
        $threed_content = $this->raw_result['UCD_HTML'] ?? false;
        if (!$threed_content) {
            $threed_content = redirect($this->raw_result['UCD_URL']);
        }
        return $threed_content;
    }

}