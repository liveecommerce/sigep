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
 * Requisição do serviço de verificação do status do cartão de postagem
 *
 * @package Live\Sigep\PostCard\Application\Service
 */
class GetPostCardStatusRequest extends AbstractUserDataRequest
{
    /**
     * Número do cartão de postagem
     *
     * @var string
     */
    private $postCardNumber;

    /**
     * Construtor da classe
     *
     * @param string $user
     * @param string $password
     * @param string $postCardNumber
     */
    public function __construct(
        string $user,
        string $password,
        string $postCardNumber
    ) {
        $this->user = $user;
        $this->password = $password;
        $this->postCardNumber = $postCardNumber;
    }

    /**
     * Retorna o número do código de postagem
     *
     * @return string
     */
    public function getPostCardNumber(): string
    {
        return $this->postCardNumber;
    }
}
