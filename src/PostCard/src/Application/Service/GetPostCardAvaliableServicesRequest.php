<?php

/**
 * Este código faz parte do pacote do SIGEP das aplicações Live eCommerce.
 * (c) Live eCommerce <dev@liveecommerce.com.br>
 *
 * @version 1.0.0
 * @since 1.0.0 criação do pacote live-sigep
 */

namespace Live\Sigep\PostCard\Application\Service;

use Live\Sigep\Sigep\Application\Service\AbstractUserDataRequest;

/**
 * Requisição do serviço de verificação dos serviços disponiveis para o cartão de postagem
 *
 * @package Live\Sigep\PostCard\Application\Service
 */
class GetPostCardAvaliableServicesRequest extends AbstractUserDataRequest
{
    /**
     * Número do cartão de postagem
     *
     * @var string
     */
    private $postCardNumber;

    /**
     * Número do contrato
     *
     * @var string
     */
    private $contract;

    /**
     * Construtor da classe
     *
     * @param string $user
     * @param string $password
     * @param string $postCardNumber
     * @param string $contract
     */
    public function __construct(
        string $user,
        string $password,
        string $postCardNumber,
        string $contract
    ) {
        $this->user = $user;
        $this->password = $password;
        $this->postCardNumber = $postCardNumber;
        $this->contract = $contract;
    }

    /**
     * Retorna o número do cartão de postagem
     *
     * @return string
     */
    public function getPostCardNumber(): string
    {
        return $this->postCardNumber;
    }

    /**
     * Retorna o contrato
     *
     * @return string
     */
    public function getContract(): string
    {
        return $this->contract;
    }
}
