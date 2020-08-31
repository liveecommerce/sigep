<?php

/**
 * Este código faz parte do pacote do SIGEP das aplicações Live eCommerce.
 * (c) Live eCommerce <dev@liveecommerce.com.br>
 *
 * @version 1.0.0
 * @since 1.0.0 criação do pacote live-sigep
 */

namespace Live\Sigep\PrePostingList\Domain\Model;

use Live\Sigep\Address\Domain\Model\Address;
use Live\Sigep\ShippingLabel\Domain\Model\ShippingLabel;

/**
 * Objeto postal
 *
 * @package Live\Sigep\PrePostingList\Domain\Model
 */
class PostalObject
{
    /**
     * Endereço
     *
     * @var Address
     */
    private $address;

    /**
     * Etiqueta
     *
     * @var ShippingLabel
     */
    private $shippingLabel;

    /**
     * Código de serviço
     *
     * @var string
     */
    private $serviceCode;

    /**
     * Peso
     *
     * @var string
     */
    private $weight;

    /**
     * Nome do destinatário
     *
     * @var string
     */
    private $receiverName;

    /**
     * Nota fiscal
     *
     * @var string
     */
    private $invoiceNumber;

    /**
     * Valor da nota fiscal
     *
     * @var string
     */
    private $invoiceValue;

    /**
     * Serviços adicionais
     *
     * @var string
     */
    private $additionalService;

    /**
     * Valor declarado
     *
     * @var string
     */
    private $declaredValue;

    /**
     * Endereço do vizinho
     *
     * @var string
     */
    private $neighborAddress;

    /**
     * Tipo de objeto postal
     *
     * @var string
     */
    private $objectType;

    /**
     * Largura
     *
     * @var string
     */
    private $height;

    /**
     * Largura
     *
     * @var string
     */
    private $width;

    /**
     * Comprimento
     *
     * @var string
     */
    private $length;

    /**
     * Diametro
     *
     * @var string
     */
    private $diameter;

    /**
     * Número do documento
     *
     * @var string
     */
    private $documentNumber;

    /**
     * Celular
     *
     * @var string
     */
    private $cellphone;

    /**
     * Construtor da classe
     *
     * @param Address $address
     * @param ShippingLabel $shippingLabel
     * @param string $serviceCode
     * @param string $weight
     * @param string $receiverName
     * @param string $objectType
     * @param string $height
     * @param string $width
     * @param string $length
     * @param string $diameter
     * @param string $documentNumber
     * @param string $invoiceNumber
     * @param string $additionalService
     * @param string $declaredValue
     * @param string $neighborAddress
     * @param string $cellphone
     * @param string $invoiceValue
     */
    public function __construct(
        Address $address,
        ShippingLabel $shippingLabel,
        string $serviceCode,
        string $weight,
        string $receiverName,
        string $objectType,
        string $height,
        string $width,
        string $length,
        string $diameter,
        string $documentNumber,
        string $invoiceNumber = '',
        string $additionalService = AdditionalServiceType::NATIONALREGISTRATION,
        string $declaredValue = '',
        string $neighborAddress = '',
        string $cellphone = '',
        string $invoiceValue = ''
    ) {
        $this->address = $address;
        $this->shippingLabel = $shippingLabel;
        $this->serviceCode = $serviceCode;
        $this->weight = $weight;
        $this->receiverName = $receiverName;
        $this->invoiceNumber = $invoiceNumber;
        $this->objectType = $objectType;
        $this->height = $height;
        $this->width = $width;
        $this->length = $length;
        $this->diameter = $diameter;
        $this->additionalService = $additionalService;
        $this->declaredValue = $declaredValue;
        $this->neighborAddress = $neighborAddress;
        $this->documentNumber = $documentNumber;
        $this->cellphone = $cellphone;
        $this->invoiceValue = $invoiceValue;
    }

    /**
     * Retorna o valor o endereço
     *
     * @return Address
     */ 
    public function getAddress(): Address
    {
        return $this->address;
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
     * Retorna o valor do código de serviço
     *
     * @return string
     */
    public function getServiceCode(): string
    {
        return $this->serviceCode;
    }

    /**
     * Retorna o valor do peso
     * 
     * @return string
     */ 
    public function getWeight(): string
    {
        return $this->weight;
    }

    /**
     * Retorna o nome do destinatário
     *
     * @return string
     */
    public function getReceiverName(): string
    {
        return $this->receiverName;
    }

    /**
     * Retorna o número da nota fiscal
     *
     * @return string
     */
    public function getInvoiceNumber(): string
    {
        return $this->invoiceNumber;
    }

    /**
     * Retorna o valor da nota fiscal
     *
     * @return string
     */
    public function getInvoiceValue(): string
    {
        return $this->invoiceValue;
    }

    /**
     * Retorna o valor do serviço adicional
     *
     * @return string
     */
    public function getAdditionalService(): string
    {
        return $this->additionalService;
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
     * Retorna o valor do endereço do vizinho
     *
     * @return string
     */
    public function getNeighborAddress(): string
    {
        return $this->neighborAddress;
    }

    /**
     * Retorna o valor do tipo de objeto
     *
     * @return string
     */
    public function getObjectType(): string
    {
        return $this->objectType;
    }

    /**
     * Retorna o valor da Largura
     *
     * @return string
     */
    public function getHeight(): string
    {
        return $this->height;
    }

    /**
     * Retorna o valor do número do documento
     *
     * @return string
     */
    public function getDocumentNumber(): string
    {
        return $this->documentNumber;
    }

    /**
     * Retorna o valor do celular
     *
     * @return string
     */
    public function getCellphone(): string
    {
        return $this->cellphone;
    }

    /**
     * Retorna o valor da lagura baseado no tipo de encomenda
     *
     * @return string
     */
    public function getHeightBasedOnObjectType(): string
    {
        if ($this->objectType == PostalObjectType::PACKAGEBOX) {
            return $this->height;
        }

        return '0';
    }

    /**
     * Retorna o valor da altura
     *
     * @return string
     */
    public function getWidth(): string
    {
        return $this->width;
    }

     /**
     * Retorna o valor da altura baseado no tipo de encomenda
     *
     * @return string
     */
    public function getWidthBasedOnObjectType(): string
    {
        if ($this->objectType == PostalObjectType::PACKAGEBOX) {
            return $this->width;
        }

        return '0';
    }

    /**
     * Retorna o valor do comprimento
     *
     * @return string
     */
    public function getLength(): string
    {
        return $this->length;
    }

    /**
     * Retorna o valor do comprimento baseado no tipo de encomenda
     *
     * @return string
     */
    public function getLengthBasedOnObjectType(): string
    {
        switch ($this->objectType) {
            case PostalObjectType::PACKAGEBOX:
            case PostalObjectType::SPHERICALCYLINDERROLLER:
                return $this->length;
            default:
                return '0';
        }
    }

    /**
     * Retorna o valor do diametro
     *
     * @return string
     */
    public function getDiameter(): string
    {
        return $this->diameter;
    }

    /**
     * Retorna o valor do diametro baseado no tipo de encomenda
     *
     * @return string
     */
    public function getDiameterBasedOnObjectType(): string
    {
        if ($this->objectType == PostalObjectType::SPHERICALCYLINDERROLLER) {
            return $this->diameter;
        }

        return '0';
    }
}
