<?php

/**
 * Este código faz parte do pacote do SIGEP das aplicações Live eCommerce.
 * (c) Live eCommerce <dev@liveecommerce.com.br>
 *
 * @version 1.0.0
 * @since 1.0.0 criação do pacote live-sigep
 */

namespace Live\Sigep\ShippingLabel\Application\Service;

use Live\Sigep\ShippingLabel\Domain\Model\ShippingLabel;
use Live\Sigep\Sigep\Application\Service\AbstractGenerateXml;
use Live\Sigep\SoapClient\Application\Service\SoapClientService;

/**
 * Serviço de busca de etiquetas
 *
 * @package Live\Sigep\ShippingLabel\Application\Service
 */
class GetShippingLabelsService extends AbstractGenerateXml
{
    /**
     * Executa o serviço
     *
     * @param GetShippingLabelsRequest $request
     * @return GetShippingLabelsResponse
     */
    public function __invoke(GetShippingLabelsRequest $request): GetShippingLabelsResponse
    {
        $response = new GetShippingLabelsResponse();
        $soapClientService = new SoapClientService($request->getSandbox());

        $method = "solicitaEtiquetas";
        $data = [
            'tipoDestinatario' => $request->getReceiverType(),
            'identificador' => $request->getCnpj(),
            'idServico' => $request->getServiceId(),
            'qtdEtiquetas' => (int) $request->getQuantityLabels(),
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
                'message' => 'No labels was returned.'
            ]);
        }

        $labels = explode(',', $result->return);

        $getVerifyingDigitService = new GetVerifyingDigitService();

        $shippingLabels = [];
        foreach ($labels as $label) {
            $shippingLabel = new ShippingLabel($label);

            $shippingLabel = $getVerifyingDigitService($shippingLabel);

            if (!$shippingLabel->getLabel()) {
                continue;
            }

            $shippingLabels[] = $shippingLabel;

            if ($request->getQuantityLabels() == 1) {
                break;
            }
        }

        $response->setData($shippingLabels);

        return $response->succeed();
    }
}
