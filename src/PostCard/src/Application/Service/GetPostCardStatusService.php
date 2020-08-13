<?php

/**
 * Este código faz parte do pacote do SIGEP das aplicações Live eCommerce.
 * (c) Live eCommerce <dev@liveecommerce.com.br>
 *
 * @version 1.0.0
 * @since 1.0.0 criação do pacote live-sigep
 */

namespace Live\Sigep\PostCard\Application\Service;

use Live\Sigep\PostCard\Domain\Model\PostCardStatus;
use Live\Sigep\Sigep\Application\Service\AbstractGenerateXml;
use Live\Sigep\SoapClient\Application\Service\SoapClientService;

/**
 * Serviço de verificação do status do cartão de postagem
 *
 * @package Live\Sigep\PostCard\Application\Service
 */
class GetPostCardStatusService extends AbstractGenerateXml
{
    /**
     * Executa o serviço
     *
     * @param GetPostCardStatusRequest $request
     * @return GetPostCardStatusResponse
     */
    public function __invoke(GetPostCardStatusRequest $request): GetPostCardStatusResponse
    {
        $response = new GetPostCardStatusResponse();
        $soapClientService = new SoapClientService($request->getSandbox());

        $method = "getStatusCartaoPostagem";
        $data = [
            'numeroCartaoPostagem' => $request->getPostCardNumber(),
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
                'message' => 'Unexpected Error'
            ]);
        }

        $status = strtolower($result->return);

        if ($status != PostCardStatus::NORMAL && $status != PostCardStatus::CANCELADO) {
            return $response->fail([
                'message' => 'The Post Card status is not listed',
                'status' => $status
            ]);
        }

        $postCardStatus = new PostCardStatus($status);
        $response->setObject($postCardStatus);

        return $response->succeed();
    }
}
