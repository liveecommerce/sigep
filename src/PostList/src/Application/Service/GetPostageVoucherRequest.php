<?php

/**
 * Este código faz parte do pacote do SIGEP das aplicações Live eCommerce.
 * (c) Live eCommerce <dev@liveecommerce.com.br>
 *
 * @version 1.0.0
 * @since 1.0.0 criação do pacote live-sigep
 */

namespace Live\Sigep\PostList\Application\Service;

use Live\Sigep\PrePostingList\Domain\Model\PrePostingList;

/**
 * Requisição do serviço de geração do voucher de postagem
 *
 * @package Live\Sigep\PostList\Application\Service
 */
class GetPostageVoucherRequest
{
    /**
     * Pre-lista de postagem
     *
     * @var PrePostingList
     */
    private $prePostingList;

    /**
     * Contrato
     *
     * @var string
     */
    private $contract;

    /**
     * Nome do cliente do sigep
     *
     * @var string
     */
    private $clientName;

    /**
     * Email
     *
     * @var string
     */
    private $email;

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
     * Nome do remetente
     *
     * @var string
     */
    private $senderName;

    /**
     * Construtor da classe
     *
     * @param PrePostingList $prePostingList
     * @param string $contract
     * @param array $postCardServices
     * @param string $postDate
     * @param string $telephone
     * @param string $senderName
     * @param string $clientName
     * @param string $email
     */
    public function __construct(
        PrePostingList $prePostingList,
        string $contract,
        array $postCardServices,
        string $postDate,
        string $telephone,
        string $senderName,
        string $clientName = 'ECT',
        string $email = null
    ) {
        $this->prePostingList = $prePostingList;
        $this->contract = $contract;
        $this->senderName = $senderName;
        $this->clientName = $clientName;
        $this->postCardServices = $postCardServices;
        $this->postDate = $postDate;
        $this->telephone = $telephone;
        $this->email = $email;
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
     * Retorna o valor do email
     *
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
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
}
