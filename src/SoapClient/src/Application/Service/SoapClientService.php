<?php

/**
 * Este código faz parte do pacote do SIGEP das aplicações Live eCommerce.
 * (c) Live eCommerce <dev@liveecommerce.com.br>
 *
 * @version 1.0.0
 * @since 1.0.0 criação do pacote live-sigep
 */

namespace Live\Sigep\SoapClient\Application\Service;

use DOMDocument;
use Live\Sigep\Sigep\Application\Service\AbstractGenerateXml;
use stdClass;
use Exception;
use SimpleXMLElement;

/**
 * Serviço de conexão Soap
 *
 * Live\Sigep\SoapClient\Application\Service
 */
class SoapClientService extends AbstractGenerateXml
{
    /**
     * Url dos correios
     *
     * @var string
     */
    private $url = 'https://apps.correios.com.br/SigepMasterJPA/AtendeClienteService/AtendeCliente?wsdl';

    /**
     * Url de desenvolvimento dos correios
     *
     * @var string
     */
    private $sandboxUrl = 'https://apphom.correios.com.br/SigepMasterJPA/AtendeClienteService/AtendeCliente?wsdl';

    /**
     * Desenvolvimento
     *
     * @var bool
     */
    private $sandbox;

    /**
     * Corpo do retorno do xml para comparação
     *
     * @var string
     */
    private $regex = "/\<return\>.*\<\/return\>/";

     /**
     * Corpo do retorno do xml com erro para comparação
     *
     * @var string
     */
    private $regexError = "/\<faultstring\>.*\<\/faultstring\>/";

    /**
     * Tag base do xml
     *
     * @var string
     */
    const BASE_TAG = "SOAP-ENV:Envelope";

    /**
     * Attributos básicos do xml
     * 
     * @var array
     */
    const BASE_ATTRIBUTES = [
        "xmlns:SOAP-ENV" => "http://schemas.xmlsoap.org/soap/envelope/",
        "xmlns:ns1" => "http://cliente.bean.master.sigep.bsb.correios.com.br/"
    ];

    /**
     * Tag de corpo do xml
     *
     * @var string
     */
    const BODY_TAG = "SOAP-ENV:Body";

    /**
     * Construtor da classe
     *
     * @param bool $sandbox
     */
    public function __construct(?bool $sandbox = false)
    {
        $this->sandbox = $sandbox;
    }

    /**
     * Executa o serviço
     *
     * @param array $data
     * @return stdClass
     */
    public function __invoke(string $data): SimpleXMLElement
    {
        $url = $this->sandbox ? $this->sandboxUrl : $this->url;

        $header = [
            'Accept: text/xml',
            'Accept: text/xml',
            'Cache-Control: no-cache',
            'Pragma: no-cache',
            'Content-type: text/xml; charset="ISO-8859-1"'
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        curl_setopt($ch, CURLOPT_ENCODING, "");

        $response = curl_exec($ch);
        $error = curl_error($ch);
        curl_close($ch);

        if ($error) {
            throw new Exception($error);
        }

        $response = utf8_encode($response);

        $unformattedResponse = strpos($data, 'solicitaXmlPlp');
        if ($unformattedResponse) {
            $response = trim(htmlspecialchars_decode($response));
            $response = str_replace(["\r", "\n", '<?xml version="1.0" encoding="ISO-8859-1"?>'], '', $response);
        }

        preg_match($this->regexError, $response, $xmlError);
        if ($xmlError[0]) {
            $object = simplexml_load_string("<response>" . $xmlError[0] . "</response>");
            throw new Exception($object->faultstring);
        }

        preg_match($this->regex, $response, $xml);
        $object = simplexml_load_string("<response>" . $xml[0] . "</response>");

        return $object;
    }
}
