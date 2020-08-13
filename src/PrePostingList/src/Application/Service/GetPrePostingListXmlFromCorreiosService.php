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
 * Serviço de busca do xml da pré lista de postagem
 *
 * @package Live\Sigep\PrePostingList\Application\Service
 */
class GetPrePostingListXmlFromCorreiosService extends AbstractGenerateXml
{
    /**
     * Executa o serviço
     *
     * @param GetPrePostingListXmlFromCorreiosRequest $request
     * @return GetPrePostingListXmlFromCorreiosResponse
     */
    public function __invoke(
        GetPrePostingListXmlFromCorreiosRequest $request
    ): GetPrePostingListXmlFromCorreiosResponse {
        $response = new GetPrePostingListXmlFromCorreiosResponse();
        $soapClientService = new SoapClientService($request->getSandbox());

        $method = "solicitaXmlPlp";
        $data = [
            'idPlpMaster' => $request->getPlpNumber(),
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

        $plp = [];
        $plp['xml'] = $result->return;

        $response = new GetPrePostingListXmlFromCorreiosResponse();
        $response->setData($plp);

        return $response->succeed();
    }
}
