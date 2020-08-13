<?php

/**
 * Este código faz parte do pacote do SIGEP das aplicações Live eCommerce.
 * (c) Live eCommerce <dev@liveecommerce.com.br>
 *
 * @version 1.0.0
 * @since 1.0.0 criação do pacote live-sigep
 */

namespace Live\Sigep\DeliveryAvailability\Application\Service;

use Live\Sigep\DeliveryAvailability\Domain\Model\DeliveryAvailability;
use Live\Sigep\Sigep\Application\Service\AbstractGenerateXml;
use Live\Sigep\SoapClient\Application\Service\SoapClientService;

/**
 * Serviço de busca de disponibilidade de envio
 *
 * @package Live\Sigep\DeliveryAvailability\Application\Service
 */
class GetDeliveryAvailabilityService extends AbstractGenerateXml
{
    /**
     * Executa o serviço
     *
     * @param GetDeliveryAvailabilityRequest $request
     * @return GetDeliveryAvailabilityResponse
     */
    public function __invoke(GetDeliveryAvailabilityRequest $request): GetDeliveryAvailabilityResponse
    {
        $response = new GetDeliveryAvailabilityResponse();
        $soapClientService = new SoapClientService($request->getSandbox());

        $method = "verificaDisponibilidadeServico";
        $data = [
            'codAdministrativo' => $request->getAdministrativeCode(),
            'numeroServico' => $request->getServiceCode(),
            'cepOrigem' => $request->getZipCodeOrigin(),
            'cepDestino' => $request->getZipCodeDestiny(),
            'usuario' => $request->getUser(),
            'senha' => $request->getPassword()
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

        $data = explode('#', $result->return);

        $id = $data[0];
        $message = $data[1] ? trim($data[1]) : 'Processamento com sucesso';

        $deliveryAvailability = new DeliveryAvailability($id, $message);

        $response->setObject($deliveryAvailability);

        return $response->succeed();
    }
}
