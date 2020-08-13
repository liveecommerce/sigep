<?php

/**
 * Este código faz parte do pacote do SIGEP das aplicações Live eCommerce.
 * (c) Live eCommerce <dev@liveecommerce.com.br>
 *
 * @version 1.0.0
 * @since 1.0.0 criação do pacote live-sigep
 */

namespace Live\Sigep\Address\Application\Service;

use Live\Sigep\Address\Domain\Model\Address;
use Live\Sigep\Sigep\Application\Service\AbstractGenerateXml;
use Live\Sigep\SoapClient\Application\Service\SoapClientService;
/**
 * Serviço de busca de endereço por código postal
 *
 * @package Live\Sigep\Address\Application\Service
 */
class GetAddressByZipCodeService extends AbstractGenerateXml
{
    /**
     * Executa o serviço
     *
     * @param GetAddressByZipCodeRequest $request
     * @return GetAddressByZipCodeResponse
     */
    public function __invoke(GetAddressByZipCodeRequest $request): GetAddressByZipCodeResponse
    {
        $response = new GetAddressByZipCodeResponse();
        $soapClientService = new SoapClientService($request->getSandbox());

        $method = "consultaCEP";
        $data = [
            'cep' => $request->getZipCode(),
        ];

        $this->createXmlDocument(SoapClientService::BASE_TAG, 'ISO-8859-1', SoapClientService::BASE_ATTRIBUTES);

        $body = [
            SoapClientService::BODY_TAG => [
                "ns1:$method" => $data
            ]
        ];

        $this->addElement($body);

        $xml = $this->getXml();
        $result = $soapClientService($xml);

        if (!$result) {
            return $response->fail([
                'message' => 'Unexpected error.'
            ]);
        }

        if (!$result->return) {
            return $response->fail([
                'message' => 'No Sigep data was returned.'
            ]);
        }

        $data = $result->return;

        $zipCode = $data->cep;
        $street = $data->end;
        $district = $data->bairro;
        $city = $data->cidade;
        $state = $data->uf;
        $complement = $data->complemento;
        $additionalComplement = $data->complemento2;

        $addressObject = new Address(
            $zipCode,
            $street,
            $district,
            $city,
            $state
        );

        $addressObject->setComplement($complement);
        $addressObject->setAdditionalComplement($additionalComplement);

        $response->setObject($addressObject);

        return $response->succeed();
    }
}
