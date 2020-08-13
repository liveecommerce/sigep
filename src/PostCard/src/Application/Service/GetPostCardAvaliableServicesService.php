<?php

/**
 * Este código faz parte do pacote do SIGEP das aplicações Live eCommerce.
 * (c) Live eCommerce <dev@liveecommerce.com.br>
 *
 * @version 1.0.0
 * @since 1.0.0 criação do pacote live-sigep
 */

namespace Live\Sigep\PostCard\Application\Service;

use Live\Sigep\PostCard\Domain\Model\PostCardService;
use Live\Sigep\PostCard\Domain\Model\PostCardAvaliableServices;
use Live\Sigep\Sigep\Application\Service\AbstractGenerateXml;
use Live\Sigep\SoapClient\Application\Service\SoapClientService;

/**
 * Serviço de verificação dos serviços disponiveis para o cartão de postagem
 *
 * @package Live\Sigep\PostCard\Application\Service
 */
class GetPostCardAvaliableServicesService extends AbstractGenerateXml
{
    /**
     * Executa o serviço
     *
     * @param GetPostCardAvaliableServicesRequest $request
     * @return GetPostCardAvaliableServicesResponse
     */
    public function __invoke(GetPostCardAvaliableServicesRequest $request): GetPostCardAvaliableServicesResponse
    {
        $response = new GetPostCardAvaliableServicesResponse();
        $soapClientService = new SoapClientService($request->getSandbox());

        $method = "buscaCliente";
        $data = [
            'idContrato' => $request->getContract(),
            'idCartaoPostagem' => $request->getPostCardNumber(),
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

        $contract = $result->return->contratos->cartoesPostagem;

        if (!$contract) {
            return $response->fail([
                'message' => 'No services found.'
            ]);
        }

        $cnpj = trim($result->return->cnpj);

        $administrativeCode = trim($contract->codigoAdministrativo);
        $postCardNumber = trim($contract->numero);

        $postCardAvaliableServices = new PostCardAvaliableServices($administrativeCode, $postCardNumber, $cnpj);

        foreach ($contract->servicos as $service) {
            $id = (int) $service->id;
            $serviceCode = trim($service->codigo);
            $description = trim($service->descricao);

            $postCardService = new PostCardService($id, $serviceCode, $description);

            $postCardAvaliableServices->addService($postCardService);
        }

        $response->setObject($postCardAvaliableServices);

        return $response->succeed();
    }
}
