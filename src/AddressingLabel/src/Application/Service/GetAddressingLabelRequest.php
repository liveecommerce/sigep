<?php

/**
 * Este código faz parte do pacote do SIGEP das aplicações Live eCommerce.
 * (c) Live eCommerce <dev@liveecommerce.com.br>
 *
 * @version 1.0.0
 * @since 1.0.0 criação do pacote live-sigep
 */

namespace Live\Sigep\AddressingLabel\Application\Service;

use Live\Sigep\Address\Domain\Model\Address;
use Live\Sigep\ShippingLabel\Domain\Model\ShippingLabel;

/**
 * Requisição do serviço de criação de rótulo de endereçamento dos Correios
 *
 * @package Live\Sigep\AddressingLabel\Application\Service
 */
class GetAddressingLabelRequest
{
    /**
     * Endereço do destinatário
     *
     * @var Address
     */
    private $receiverAddress;

    /**
     * Endereço do remetente
     *
     * @var Address
     */
    private $senderAddress;

    /**
     * Etiqueta dos Correios
     *
     * @var ShippingLabel
     */
    private $shippingLabel;

    /**
     * Nota fiscal
     *
     * @var string
     */
    private $invoice;

    /**
     * Tipo de envio
     *
     * @var int
     */
    private $shippingType;

    /**
     * Id do pedido
     *
     * @var string
     */
    private $orderId;

    /**
     * Nome do destinatário
     *
     * @var string
     */
    private $receiverName;

    /**
     * Nome do remetente
     *
     * @var string
     */
    private $senderName;

    /**
     * Serviços adicionais
     *
     * @var array
     */
    private $additionalServices;

    /**
     * Contrato
     *
     * @var string
     */
    private $contract;

     /**
     * Cartão de postagem
     *
     * @var string
     */
    private $postCard;

    /**
     * Código de serviço
     *
     * @var string
     */
    private $serviceCode;

    /**
     * Informações de agrupamento
     *
     * @var string
     */
    private $groupingInformation;

    /**
     * Valor declarado
     *
     * @var int
     */
    private $declaredValue;

    /**
     * Url do logo
     *
     * @var string
     */
    private $logoUrl;

    /**
     * Identificação dos dados variáveis
     *
     * @var string
     */
    private $variableDataIdentifier;

    /**
     * Formato do rótulo
     *
     * @var int
     */
    private $format;

    /**
     * Peso
     *
     * @var int
     */
    private $weight;

    /**
     * Construtor da classe
     *
     * @param string $format
     * @param Address $receiverAddress
     * @param Address $senderAddress
     * @param ShippingLabel $shippingLabel
     * @param integer $weight
     * @param string $invoice
     * @param integer $shippingType
     * @param string $orderId
     * @param string $receiverName
     * @param string $senderName
     * @param string $contract
     * @param string $postCard
     * @param string $serviceCode
     * @param integer $declaredValue
     * @param string $logoUrl
     * @param string $groupingInformation
     * @param array $additionalServices
     * @param string $variableDataIdentifier
     */
    public function __construct(
        string $format = "1",
        Address $receiverAddress,
        Address $senderAddress,
        ShippingLabel $shippingLabel,
        int $weight,
        string $invoice,
        int $shippingType,
        string $orderId,
        string $receiverName,
        string $senderName,
        string $contract,
        string $postCard,
        string $serviceCode,
        int $declaredValue,
        string $logoUrl = null,
        string $groupingInformation = '00',
        array $additionalServices = [],
        string $variableDataIdentifier = '51'
    ) {
        $this->receiverAddress = $receiverAddress;
        $this->senderAddress = $senderAddress;
        $this->shippingLabel = $shippingLabel;
        $this->contract = $contract;
        $this->postCard = $postCard;
        $this->serviceCode = $serviceCode;
        $this->groupingInformation = $groupingInformation;
        $this->declaredValue = $declaredValue;
        $this->additionalServices = $additionalServices;
        $this->variableDataIdentifier = $variableDataIdentifier;
        $this->invoice = $invoice;
        $this->shippingType = $shippingType;
        $this->orderId = $orderId;
        $this->receiverName = $receiverName;
        $this->senderName = $senderName;
        $this->format = $format;
        $this->weight = $weight;
        $this->logoUrl = $logoUrl;
    }

    /**
     * Retorna o valor do endereço do destinatário
     *
     * @return Address
     */
    public function getReceiverAddress(): Address
    {
        return $this->receiverAddress;
    }

    /**
     * Retorna o valor do endereço do remetente
     *
     * @return Address
     */
    public function getSenderAddress(): Address
    {
        return $this->senderAddress;
    }

    /**
     * Retorna o valor da etiqueta
     *
     * @return ShippingLabel
     */
    public function getShippingLabel(): ShippingLabel
    {
        return $this->shippingLabel;
    }

    /**
     * Retorna o valor dos serviços adicionais
     *
     * @return array
     */
    public function getAdditionalServices(): array
    {
        return $this->additionalServices;
    }

    /**
     * Retorna o valor do contrato
     *
     * @return string
     */
    public function getContract(): string
    {
        return $this->contract;
    }

     /**
     * Retorna o valor do cartão de postagem
     *
     * @return string
     */
    public function getPostCard(): string
    {
        return $this->postCard;
    }

    /**
     * Retorna o valor do código de serviço
     *
     * @return string
     */
    public function getServiceCode(): string
    {
        return $this->serviceCode;
    }

    /**
     * Retorna o valor da informação de agrupamento
     *
     * @return string
     */
    public function getGroupingInformation(): string
    {
        return $this->groupingInformation;
    }

    /**
     * Retorna o valor do valor declarado
     *
     * @return string
     */
    public function getDeclaredValue(): string
    {
        return $this->declaredValue;
    }

    /**
     * Retorna o valor da identificação dos dados variáveis
     *
     * @return string
     */
    public function getVariableDataIdentifier(): string
    {
        return $this->variableDataIdentifier;
    }

    /**
     * Retorna o valor da nota fiscal
     *
     * @return string
     */
    public function getInvoice(): string
    {
        return $this->invoice;
    }

    /**
     * Retorna o valor do tipo de envio
     *
     * @return string
     */
    public function getShippingType(): string
    {
        return $this->shippingType;
    }

    /**
     * Retorna o valor do id do pedido
     *
     * @return string
     */ 
    public function getOrderId(): string
    {
        return $this->orderId;
    }

    /**
     * Retorna o valor do nome do destinatário
     *
     * @return string
     */
    public function getReceiverName(): string
    {
        return $this->receiverName;
    }

    /**
     * Retorna o valor do nome do remetente
     *
     * @return string
     */
    public function getSenderName(): string
    {
        return $this->senderName;
    }

    /**
     * Retorna o valor do formato
     *
     * @return integer
     */ 
    public function getFormat(): int
    {
        return $this->format;
    }

    /**
     * Retorna o valor do peso
     *
     * @return integer
     */ 
    public function getWeight(): int
    {
        return $this->weight;
    }

    /**
     * Retorna o valor da url do logo
     *
     * @return string
     */
    public function getLogoUrl(): string
    {
        return $this->logoUrl;
    }
}
