<?php

/**
 * Este código faz parte do pacote do SIGEP das aplicações Live eCommerce.
 * (c) Live eCommerce <dev@liveecommerce.com.br>
 *
 * @version 1.0.0
 * @since 1.0.0 criação do pacote live-sigep
 */

namespace Live\Sigep\PrePostingList\Application\Service;

use Live\Sigep\Address\Domain\Model\Address;
use Live\Sigep\Sigep\Application\Service\AbstractUserDataRequest;

/**
 * Requisição do serviço de finalização da pré lista de postagem
 *
 * @package Live\Sigep\PrePostingList\Application\Service
 */
class ClosePrePostingListRequest extends AbstractUserDataRequest
{
    /**
     * Endereço do remetente
     *
     * @var Address
     */
    private $senderAddress;

    /**
     * Objetos postais
     *
     * @var array
     */
    private $postalObjects;

    /**
     * Identificação do cliente
     *
     * @var integer
     */
    private $prePostingListClientId;

    /**
     * Identificação do cartão de postagem
     *
     * @var string
     */
    private $postCardId;

    /**
     * Contrato
     *
     * @var string
     */
    private $contract;

    /**
     * Lista de etiquetas
     *
     * @var array
     */
    private $shippingLabels;

    /**
     * Código da diretoria regional
     *
     * @var int
     */
    private $regionalCodeBoard;

    /**
     * Código administrativo
     *
     * @var string
     */
    private $administrativeCode;

    /**
     * Nome do remetente
     *
     * @var string
     */
    private $senderName;

    /**
     * Celular
     *
     * @var string
     */
    private $cellphone;

    /**
     * Construtor da classe
     *
     * @param string $user
     * @param string $password
     * @param Address $senderAddress
     * @param array $postalObjects
     * @param integer $prePostingListClientId
     * @param string $postCardId
     * @param string $contract
     * @param string $administrativeCode
     * @param array $shippingLabels
     * @param string $senderName
     * @param integer $regionalCodeBoard
     * @param string $documentNumber
     * @param string $cellphone
     */
    public function __construct(
        string $user,
        string $password,
        Address $senderAddress,
        array $postalObjects,
        int $prePostingListClientId,
        string $postCardId,
        string $contract,
        string $administrativeCode,
        array $shippingLabels,
        string $senderName,
        int $regionalCodeBoard,
        string $documentNumber,
        string $cellphone = ''
    ) {
        $this->senderAddress = $senderAddress;
        $this->postalObjects = $postalObjects;
        $this->prePostingListClientId = $prePostingListClientId;
        $this->postCardId = $postCardId;
        $this->contract = $contract;
        $this->administrativeCode = $administrativeCode;
        $this->shippingLabels = $shippingLabels;
        $this->senderName = $senderName;
        $this->regionalCodeBoard = $regionalCodeBoard;
        $this->user = $user;
        $this->password = $password;
        $this->documentNumber = $documentNumber;
        $this->cellphone = $cellphone;
    }

    /**
     * Retorna o valor da identificação do cliente
     *
     * @return integer
     */
    public function getPrePostingListClientId(): int
    {
        return $this->prePostingListClientId;
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
     * Retorna o valor dos códigos postais
     *
     * @return array
     */
    public function getPostalObjects(): array
    {
        return $this->postalObjects;
    }

    /**
     * Retorna o valor da identificação do cartão de postagem
     *
     * @return string
     */
    public function getPostCardId(): string
    {
        return $this->postCardId;
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
     * Retorna o valor das etiquetas
     *
     * @return array
     */
    public function getShippingLabels(): array
    {
        return $this->shippingLabels;
    }

    /**
     * Retorna o valor do código da diretoria regional
     *
     * @return integer
     */
    public function getRegionalCodeBoard(): int
    {
        return $this->regionalCodeBoard;
    }

    /**
     * Retorna o valor do código administrativo
     *
     * @return string
     */
    public function getAdministrativeCode(): string
    {
        return $this->administrativeCode;
    }

    /**
     * Retorna o valor do nome do Remetente
     *
     * @return string
     */
    public function getSenderName(): string
    {
        return $this->senderName;
    }

    /**
     * Retorna o valor do número do documento do remetente
     *
     * @return string
     */
    public function getDocumentNumber(): string
    {
        return $this->documentNumber;
    }

    /**
     * Retorna o valor do celular do remetente
     *
     * @return string
     */
    public function getCellphone(): string
    {
        return $this->cellphone;
    }
}
