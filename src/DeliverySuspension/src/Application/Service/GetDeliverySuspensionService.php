<?php

/**
 * Este código faz parte do pacote do SIGEP das aplicações Live eCommerce.
 * (c) Live eCommerce <dev@liveecommerce.com.br>
 *
 * @version 1.0.0
 * @since 1.0.0 criação do pacote live-sigep
 */

namespace Live\Sigep\DeliverySuspension\Application\Service;

use Live\Sigep\Sigep\Application\Service\AbstractGenerateXml;
use Live\Sigep\SoapClient\Application\Service\SoapClientService;

/**
 * Serviço de suspensão de envio de encomenda
 *
 * @package Live\Sigep\DeliverySuspension\Application\Service
 */
class GetDeliverySuspensionService extends AbstractGenerateXml
{
    /**
     * Executa o serviço
     *
     * @param GetDeliverySuspensionRequest $request
     * @return GetDeliverySuspensionResponse
     */
    public function __invoke(
        GetDeliverySuspensionRequest $request
    ): GetDeliverySuspensionResponse {
        $response = new GetDeliverySuspensionResponse();
        $soapClientService = new SoapClientService($request->getSandbox());

        $method = "bloquearObjeto";
        $data = [
            'numeroEtiqueta' => $request->getShippingLabel()->getLabel(),
            'idPlp' => $request->getPrePostingList()->getId(),
            'tipoBloqueio' => 'FRAUDE_BLOQUEIO',
            'acao' => 'DEVOLVIDO_AO_REMETENTE',
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
                'message' => 'No xml was returned.'
            ]);
        }

        $dataResponse['data'] = $result->return;

        $response->setData($dataResponse);

        return $response->succeed();
    }
}
