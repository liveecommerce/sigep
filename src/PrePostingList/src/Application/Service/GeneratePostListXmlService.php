<?php

/**
 * Este código faz parte do pacote do SIGEP das aplicações Live eCommerce.
 * (c) Live eCommerce <dev@liveecommerce.com.br>
 *
 * @version 1.0.0
 * @since 1.0.0 criação do pacote live-sigep
 */

namespace Live\Sigep\PrePostingList\Application\Service;

use Live\Sigep\PrePostingList\Domain\Model\PostalObject;
use Live\Sigep\Sigep\Application\Service\AbstractGenerateXml;

/**
 * Serviço de geração do xml da pré lista de postagem
 *
 * @package Live\Sigep\PrePostingList\Application\Service
 */
class GeneratePostListXmlService extends AbstractGenerateXml
{
    /**
     * Constante do xsd para validação do xml
     */
    const CORREIOS_XSD = 'http://www.corporativo.correios.com.br/encomendas/sigepweb/doc/SIGEPWEB_VALIDADOR_XML_V2.XSD';

    /**
     * Executa o serviço
     *
     * @param ClosePrePostingListRequest $request
     * @return string
     */
    public function __invoke(ClosePrePostingListRequest $request): GeneratePostListXmlResponse
    {
        $response = new GeneratePostListXmlResponse();

        $baseTag = "correioslog";
        $this->createXmlDocument($baseTag, 'utf-8');
        $senderAddress = $request->getSenderAddress();

        $data = [
            'tipo_arquivo' => 'Postagem',
            'versao_arquivo' => '2.3',
            'plp' => [
                'id_plp' => '',
                'valor_global' => '',
                'mcu_unidade_postagem' => '',
                'nome_unidade_postagem' => '',
                'cartao_postagem' => $request->getPostCardId()
            ],
            'remetente' => [
                'numero_contrato' => $request->getContract(),
                'numero_diretoria' => $request->getRegionalCodeBoard(),
                'codigo_administrativo' => $request->getAdministrativeCode(),
                'nome_remetente' => [
                    "value" => $request->getSenderName(),
                    "C_DATA" => true
                ],
                'logradouro_remetente' => [
                    "value" => $senderAddress->getStreet(),
                    "C_DATA" => true
                ],
                'numero_remetente' => [
                    "value" => $senderAddress->getNumber(),
                    "C_DATA" => true
                ],
                'complemento_remetente' => [
                    "value" => $senderAddress->getComplement() ?: "",
                    "C_DATA" => true
                ],
                'bairro_remetente' => [
                    "value" => $senderAddress->getDistrict(),
                    "C_DATA" => true
                ],
                'cep_remetente' => [
                    "value" => $senderAddress->getZipCode(),
                    "C_DATA" => true
                ],
                'cidade_remetente' => [
                    "value" => $senderAddress->getCity(),
                    "C_DATA" => true
                ],
                'uf_remetente' => [
                    "value" => $senderAddress->getState(),
                    "C_DATA" => false
                ],
                'telefone_remetente' => '',
                'fax_remetente' => '',
                'email_remetente' => '',
                'celular_remetente' => $request->getCellphone(),
                'cpf_cnpj_remetente' => ''
            ],
            'forma_pagamento' => ''
        ];

        $this->addElement($data);

        $postalObject['objeto_postal'] = null;

        $postalObjects = $request->getPostalObjects();
        foreach ($postalObjects as $object) {
            $postalObject = [
                'objeto_postal' => $this->generatePostalObjectList($object)
            ];

            $this->addElement($postalObject);
        }

        $data = array_merge($data, $postalObject);

        $xml['xml'] = $this->getXml();
        $response->setData($xml);

        return $response->succeed();
    }

    /**
     * Gera o array com os dados do código postal
     *
     * @param PostalObject $postalObject
     * @return array
     */
    private function generatePostalObjectList(PostalObject $postalObject): array
    {
        $address = $postalObject->getAddress();

        $data = [
            'numero_etiqueta' => $postalObject->getShippingLabel()->getLabel(),
            'codigo_objeto_cliente' => '',
            'codigo_servico_postagem' => $postalObject->getServiceCode(),
            'cubagem' => '0.00',
            'peso' => $postalObject->getWeight(),
            'rt1' => '',
            'rt2' => '',
            'destinatario' => [
                'nome_destinatario' => [
                    "value" => $postalObject->getReceiverName(),
                    "C_DATA" => true
                ],
                'telefone_destinatario' => '',
                'celular_destinatario' => $postalObject->getCellphone(),
                'email_destinatario' => '',
                'logradouro_destinatario' => [
                    "value" => $address->getStreet(),
                    "C_DATA" => true
                ],
                'complemento_destinatario' => [
                    "value" => $address->getComplement() ?: "",
                    "C_DATA" => true
                ],
                'numero_end_destinatario' => [
                    "value" => $address->getNumber(),
                    "C_DATA" => true
                ],
                'cpf_cnpj_destinatario' => ''
            ],
            'nacional' => [
                'bairro_destinatario' => [
                    "value" => $address->getDistrict(),
                    "C_DATA" => true
                ],
                'cidade_destinatario' => [
                    "value" => $address->getCity(),
                    "C_DATA" => true
                ],
                'uf_destinatario' => $address->getState(),
                'cep_destinatario' => [
                    "value" => $address->getZipCode(),
                    "C_DATA" => true
                ],
                'codigo_usuario_postal' => '',
                'centro_custo_cliente' => '',
                'numero_nota_fiscal' => $postalObject->getInvoiceNumber(),
                'serie_nota_fiscal' => '',
                'valor_nota_fiscal' => $postalObject->getInvoiceValue(),
                'natureza_nota_fiscal' => '',
                'descricao_objeto' => '',
                'valor_a_cobrar' => ''
            ],
            'servico_adicional' => [
                'codigo_servico_adicional' => $postalObject->getAdditionalService(),
                'valor_declarado' => $postalObject->getDeclaredValue(),
            ],
            'dimensao_objeto' => $this->getObjectDimension($postalObject),
            'data_postagem_sara' => '',
            'status_processamento' => '0',
            'numero_comprovante_postagem' => '',
            'valor_cobrado' => ''
        ];

        if ($postalObject->getNeighborAddress()) {
            $data['servico_adicional'] = [
                'codigo_servico_adicional' => $postalObject->getAdditionalService(),
                'valor_declarado' => $postalObject->getDeclaredValue(),
                'endereco_vizinho' => [
                    "value" => $postalObject->getNeighborAddress() ?: "",
                    "C_DATA" => true
                ]
            ];
        }

        return $data;
    }

    /**
     * Gera o array com as dimensões da embalagem
     *
     * @param PostalObject $postalObject
     * @return array
     */
    public function getObjectDimension(PostalObject $postalObject): array
    {
        $data = [];
        switch ($postalObject->getObjectType()) {
            case '1':
                $data = [
                    'tipo_objeto' => '001',
                    'dimensao_altura' => $postalObject->getHeightBasedOnObjectType(),
                    'dimensao_largura' => $postalObject->getWidthBasedOnObjectType(),
                    'dimensao_comprimento' => $postalObject->getLengthBasedOnObjectType(),
                    'dimensao_diametro' => '0'
                ];

                break;
            case '2':
                $data = [
                    'tipo_objeto' => '002',
                    'dimensao_altura' => $postalObject->getHeightBasedOnObjectType(),
                    'dimensao_largura' => $postalObject->getWidthBasedOnObjectType(),
                    'dimensao_comprimento' => $postalObject->getLengthBasedOnObjectType(),
                    'dimensao_diametro' => '0'
                ];

                break;
            case '3':
                $data = [
                    'tipo_objeto' => '003',
                    'dimensao_altura' => '0',
                    'dimensao_largura' => '0',
                    'dimensao_comprimento' => $postalObject->getLengthBasedOnObjectType(),
                    'dimensao_diametro' => $postalObject->getDiameterBasedOnObjectType()
                ];

                break;
        }

        return $data;
    }
}
