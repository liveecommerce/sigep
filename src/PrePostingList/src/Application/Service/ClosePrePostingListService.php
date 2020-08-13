<?php

/**
 * Este código faz parte do pacote do SIGEP das aplicações Live eCommerce.
 * (c) Live eCommerce <dev@liveecommerce.com.br>
 *
 * @version 1.0.0
 * @since 1.0.0 criação do pacote live-sigep
 */

namespace Live\Sigep\PrePostingList\Application\Service;

use Live\Sigep\PrePostingList\Domain\Model\PrePostingList;
use Live\Sigep\Sigep\Application\Service\AbstractGenerateXml;
use Live\Sigep\SoapClient\Application\Service\SoapClientService;

/**
 * Serviço de finalização da pré lista de postagem
 *
 * @package Live\Sigep\PrePostingList\Application\Service
 */
class ClosePrePostingListService extends AbstractGenerateXml
{
    /**
     * Executa o serviço
     *
     * @param ClosePrePostingListRequest $request
     * @return ClosePrePostingListResponse
     */
    public function __invoke(ClosePrePostingListRequest $request): ClosePrePostingListResponse
    {
        $response = new ClosePrePostingListResponse();
        $soapClientService = new SoapClientService($request->getSandbox());

        $generatePostListXml = new GeneratePostListXmlService;

        $postListXml = $generatePostListXml($request);

        if ($postListXml->failed()) {
            return $response->fail($postListXml->getErrors());
        }

        $xml = $postListXml->getData()['xml'];
        $xml = str_replace('utf-8', 'ISO-8859-1', $xml);

        $domDocument = $this->createXmlDocument('xml', 'ISO-8859-1');

        $shippingLabels['listaEtiquetas'] = null;
        foreach ($request->getShippingLabels() as $shippingLabel) {
            $shippingLabels['listaEtiquetas'] = $shippingLabel->getShippingLabelsWithoutVerifyingDigit();

            $domDocument->addElement($shippingLabels);
        }

        $shippingLabelXml= $domDocument->getXml();

        $shippingLabelXml = str_replace("<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>", '', $shippingLabelXml);
        $shippingLabelXml = str_replace('<xml>', '', $shippingLabelXml);
        $shippingLabelXml = str_replace('</xml>', '', $shippingLabelXml);

        $method = 'fechaPlpVariosServicos';

        $data = [
            'xml' => [
                'value'=> $xml,
                'C_DATA' => true
            ],
            'idPlpCliente' => $request->getPrePostingListClientId(),
            'cartaoPostagem' => $request->getPostCardId(),
            'usuario' => $request->getUser(),
            'senha' => $request->getPassword(),
            'xmlLabel' => $shippingLabelXml
        ];

        $body = [
            SoapClientService::BODY_TAG => [
                "ns1:$method" => $data
            ]
        ];

        $this->createXmlDocument(SoapClientService::BASE_TAG, 'ISO-8859-1', SoapClientService::BASE_ATTRIBUTES);

        $this->addElement($body);
        $xml = $this->getXml();

        $xml = str_replace('<xmlLabel>', '', $xml);
        $xml = str_replace('</xmlLabel>', '', $xml);
        $xml = str_replace('&lt;', '<', $xml);
        $xml = str_replace('&gt;', '>', $xml);

        $result = $soapClientService($xml);
        if (!$result) {
            return $response->fail([
                'message' => 'Unexpected error.'
            ]);
        }

        if (!$result->return) {
            return $response->fail([
                'message' => 'No plp number was returned.'
            ]);
        }

        $data = $result->return;

        $prePostingList = new PrePostingList($data);

        $response = new ClosePrePostingListResponse();
        $response->setObject($prePostingList);

        return $response->succeed();
    }
}
