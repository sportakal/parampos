<?php


namespace Simpliers\Parampos\Request;


use DOMDocument;
use DOMElement;
use Simpliers\Parampos\Config\Config;
use Simpliers\Parampos\Exception\ParamposException;

trait MakeRequest
{
    protected $payment_model;

    private $client_code;
    private $client_username;
    private $client_password;
    private $guid;
    private $service_url;

    protected $raw_result;

    static $xml_vars = [
        'card_holder' => 'KK_Sahibi',
        'card_number' => 'KK_No',
        'card_expiry_month' => 'KK_SK_Ay',
        'card_expiry_year' => 'KK_SK_Yil',
        'card_cvc' => 'KK_CVC',
        'card_owner_phone' => 'KK_Sahibi_GSM',
        'failure_url' => 'Hata_URL',
        'success_url' => 'Basarili_URL',
        'order_id' => 'Siparis_ID',
        'order_desciption' => 'Siparis_Aciklama',
        'installment_number' => 'Taksit',
        'transaction_amount' => 'Islem_Tutar',
        'total_amount' => 'Toplam_Tutar',
        'transaction_hash' => 'Islem_Hash',
        'secure_type' => 'Islem_Guvenlik_Tip',
        'transaction_id' => 'Islem_ID',
        'ip_address' => 'IPAdr',
        'ref_url' => 'Ref_URL',
        'data1' => 'Data1',
        'data2' => 'Data2',
        'data3' => 'Data3',
        'data4' => 'Data4',
        'data5' => 'Data5',
        'data6' => 'Data6',
        'data7' => 'Data7',
        'data8' => 'Data8',
        'data9' => 'Data9',
        'data10' => 'Data10',
        'Data' => 'Data',
        'pre_auth_id' => 'Prov_ID',
        'pre_auth_amount' => 'Prov_Tutar',
        'currency_code' => 'Doviz_Kodu',
        'UCD_MD' => 'UCD_MD',
        'Islem_GUID' => 'Islem_GUID',
        'Siparis_ID' => 'Siparis_ID',
    ];

    public function setCredentials(Config $config)
    {
        $this->client_code = $config->getClientCode(); //config('parampos.param.client_code', '10738');
        $this->client_username = $config->getClientUsername(); // config('parampos.param.client_username', 'Test');
        $this->client_password = $config->getClientPassword(); // config('parampos.param.client_password', 'Test');
        $this->guid = $config->getGuid(); // config('parampos.param.guid', '0c13d406-873b-403b-9c09-a5766840d98c');
        if ($config->getEnvironment()) { //config('parampos.param.environment', 'test') == 'test'
            $this->service_url = "https://test-dmz.param.com.tr:4443/turkpos.ws/service_turkpos_test.asmx";
        } else {
            $this->service_url = "https://posws.param.com.tr/turkpos.ws/service_turkpos_prod.asmx";
        }
    }

    public function tryPayment()
    {
//        $this->setCredentials();
        $this->payment_model = $this->serialize();
        $this->getHashBase64();
        $xml = $this->makeXML($this->payment_model['wsdl'], $this->payment_model);
        $response_xml = $this->curl($xml, $this->payment_model['wsdl']);
        $response = self::parseXML($response_xml);
        return $this->raw_result = $response;
    }

    public function getRawResult()
    {
        return $this->raw_result;
    }

    private function getHashBase64()
    {
        $hashSHA2B64 = $this->payment_model['transaction_hash'];
        if ($hashSHA2B64) {
            $hashSHA2B64 = $this->client_code . $this->guid . $hashSHA2B64;
            $xml = $this->makeXML('SHA2B64', ['Data' => $hashSHA2B64]);
            $response_xml = $this->curl($xml, 'SHA2B64');
            $response = self::parseXML($response_xml);
            return $this->payment_model['transaction_hash'] = array_values($response)[0];
        }
        unset($this->payment_model['transaction_hash']);
        return '';
    }

    protected function makeXML($wsdl, $array, $add_credentials = true)
    {
        $client_code = $this->client_code;
        $client_username = $this->client_username;
        $client_password = $this->client_password;
        $guid = $this->guid;

        $dom = new DOMDocument('1.0', 'utf-8');
        $envelope = $dom->createElement('soap:Envelope');

        $attr = $dom->createAttribute('xmlns:xsi');
        $attr->value = "http://www.w3.org/2001/XMLSchema-instance";
        $envelope->appendChild($attr);

        $attr = $dom->createAttribute('xmlns:xsd');
        $attr->value = "http://www.w3.org/2001/XMLSchema";
        $envelope->appendChild($attr);

        $attr = $dom->createAttribute('xmlns:soap');
        $attr->value = "http://schemas.xmlsoap.org/soap/envelope/";
        $envelope->appendChild($attr);

        $wsdl_container = $dom->createElement($wsdl);
        $attr = $dom->createAttribute('xmlns');
        $attr->value = "https://turkpos.com.tr/";
        $wsdl_container->appendChild($attr);

        $body = $dom->createElement('soap:Body');

        foreach ($array as $key => $value) {
            if (self::$xml_vars[$key] ?? false) {
                $xml_elem = $dom->createElement(self::$xml_vars[$key] ?? $key, $value);
                $wsdl_container->appendChild($xml_elem);
            }
        }


        $g = $dom->createElement('G');

        $client_code_element = $dom->createElement('CLIENT_CODE', $client_code);
        $client_username_element = $dom->createElement('CLIENT_USERNAME', $client_username);
        $client_password_element = $dom->createElement('CLIENT_PASSWORD', $client_password);
        $g->appendChild($client_code_element);
        $g->appendChild($client_username_element);
        $g->appendChild($client_password_element);
        $guid_element = $dom->createElement('GUID', $guid);
        $wsdl_container->appendChild($g);
        $wsdl_container->appendChild($guid_element);


        $body->appendChild($wsdl_container);
        $envelope->appendChild($body);
        $dom->appendChild($envelope);

        $xml = $dom->saveXML();
        return $xml;
    }

    private function curl($xml, $wsdl)
    {
        try {
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => $this->service_url . '?op=' . $wsdl,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_SSL_VERIFYPEER => false,
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => $xml,
                CURLOPT_HTTPHEADER => array(
                    'Content-type: text/xml',
                ),
            ));
            $response = curl_exec($curl);
            $http_code = curl_getinfo($curl);
            curl_close($curl);
            return $response;
        } catch (\Exception $e) {
            throw new ParamposException($e->getMessage(), $e->getCode());
        }
    }

    static function parseXML($xml): array
    {
        $xml_result = $xml;
        $domDocument = new DOMDocument();
        $domDocument->loadXML($xml_result);
        $results = [];
        $elements = $domDocument->getElementsByTagName('*');
        foreach ($elements as $element) {
            if ($element instanceof DOMElement) {
                if ($element->childElementCount == 0) {
                    $results[$element->nodeName] = $element->nodeValue;
                }
            }

//            $results = self::getChildNodes($element, $results);
        }
        return $results;
    }
}