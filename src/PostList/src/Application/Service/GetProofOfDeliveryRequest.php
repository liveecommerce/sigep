<?php

/**
 * Este código faz parte do pacote do SIGEP das aplicações Live eCommerce.
 * (c) Live eCommerce <dev@liveecommerce.com.br>
 *
 * @version 1.0.0
 * @since 1.0.0 criação do pacote live-sigep
 */

namespace Live\Sigep\PostList\Application\Service;

use Live\Sigep\Address\Domain\Model\Address;
use Live\Sigep\PrePostingList\Domain\Model\PostalObject;

/**
 * Requisição do serviço de geração de aviso de recebimento
 *
 * @package Live\Sigep\PostList\Application\Service
 */
class GetProofOfDeliveryRequest
{
    /**
     * Endereço do remetente
     *
     * @var Address
     */
    private $senderAddress;

    /**
     * Contrato
     *
     * @var string
     */
    private $contract;

    /**
     * Código administrativo
     *
     * @var string
     */
    private $adminitrativeCode;

    /**
     * Nome do remetente
     *
     * @var string
     */
    private $senderName;

    /**
     * Objeto postal
     *
     * @var PostalObject
     */
    private $postalObject;

    /**
     * Contrutor da classe
     *
     * @param Address $senderAddress
     * @param string $contract
     * @param string $senderName
     * @param PostalObject $postalObject
     */
    public function __construct(
        Address $senderAddress,
        string $contract,
        string $senderName,
        PostalObject $postalObject
    ) {
        $this->contract = $contract;
        $this->senderName = $senderName;
        $this->senderAddress = $senderAddress;
        $this->postalObject = $postalObject;
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
     * Retorna o valor do nome do remetente
     *
     * @return string
     */
    public function getSenderName(): string
    {
        return $this->senderName;
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
     * Retorna o valor do código administrativo
     *
     * @return string
     */
    public function getAdminitrativeCode(): string
    {
        return $this->adminitrativeCode;
    }

    /**
     * Retorna o valor do objeto postal
     *
     * @return PostalObject
     */
    public function getPostalObject(): PostalObject
    {
        return $this->postalObject;
    }
}
