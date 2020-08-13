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
use Live\Sigep\PrePostingList\Domain\Model\PrePostingList;

/**
 * Requisição do serviço de geração da lista de postagem
 *
 * @package Live\Sigep\PostList\Application\Service
 */
class GetPostListRequest
{
    /**
     * Pré-lista de postagem
     *
     * @var PrePostingList
     */
    private $prePostingList;

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
     * Código adminitrativo
     *
     * @var string
     */
    private $adminitrativeCode;

    /**
     * Identificação do cartão de postagem
     *
     * @var string
     */
    private $postCardId;

    /**
     * Nome do remetente
     *
     * @var string
     */
    private $senderName;

    /**
     * Nome do cliente do sigep
     *
     * @var string
     */
    private $clientName;

    /**
     * Telefone
     *
     * @var string
     */
    private $telephone;

    /**
     * Serviços do cartão de postagem
     *
     * @var array
     */
    private $postCardServices;

    /**
     * Data de postagem
     *
     * @var string
     */
    private $postDate;

    /**
     * Objetos Postais
     *
     * @var array
     */
    private $postalObjects;

    /**
     * Construtor da classe
     *
     * @param PrePostingList $prePostingList
     * @param Address $senderAddress
     * @param string $senderName
     * @param string $contract
     * @param string $adminitrativeCode
     * @param string $postCardId
     * @param array $postCardServices
     * @param array $postalObjects
     * @param string $postDate
     * @param string $telephone
     * @param string $clientName
     */
    public function __construct(
        PrePostingList $prePostingList,
        Address $senderAddress,
        string $senderName,
        string $contract,
        string $adminitrativeCode,
        string $postCardId,
        array $postCardServices,
        array $postalObjects,
        string $postDate,
        string $telephone,
        string $clientName = 'ECT'
    ) {
        $this->prePostingList = $prePostingList;
        $this->contract = $contract;
        $this->senderName = $senderName;
        $this->clientName = $clientName;
        $this->postCardServices = $postCardServices;
        $this->postDate = $postDate;
        $this->telephone = $telephone;
        $this->senderAddress = $senderAddress;
        $this->adminitrativeCode = $adminitrativeCode;
        $this->postCardId = $postCardId;
        $this->postalObjects = $postalObjects;
    }

    /**
     * Retorna o valor da pré-lista de postagem
     *
     * @return PrePostingList
     */
    public function getPrePostingList(): PrePostingList
    {
        return $this->prePostingList;
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
     * Retorna o valor do nome do cliente do sigep
     *
     * @return string
     */
    public function getClientName(): string
    {
        return $this->clientName;
    }

    /**
     * Retorna o valor do telefone
     *
     * @return string
     */
    public function getTelephone(): string
    {
        return $this->telephone;
    }

    /**
     * Retorna o valor da data de postagem
     *
     * @return string
     */
    public function getPostDate(): string
    {
        return $this->postDate;
    }

    /**
     * Retorna o valor dos serviços do cartão de postagem
     *
     * @return array
     */
    public function getPostCardServices(): array
    {
        return $this->postCardServices;
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
     * Retorna o valor do id do cartão de postagem
     *
     * @return string
     */
    public function getPostCardId(): string
    {
        return $this->postCardId;
    }

    /**
     * Retorna o valor dos objetos de postagem
     *
     * @return array
     */
    public function getPostalObjects(): array
    {
        return $this->postalObjects;
    }
}
