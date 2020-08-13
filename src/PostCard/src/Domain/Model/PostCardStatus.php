<?php

/**
 * Este código faz parte do pacote do SIGEP das aplicações Live eCommerce.
 * (c) Live eCommerce <dev@liveecommerce.com.br>
 *
 * @version 1.0.0
 * @since 1.0.0 criação do pacote live-sigep
 */

namespace Live\Sigep\PostCard\Domain\Model;

/**
 * Status do cartão de postagem
 *
 * @package Live\Sigep\PostCard\Domain\Model
 */
class PostCardStatus
{
    const NORMAL = 'normal';
    const CANCELADO = 'cancelado';

    /**
     * Status
     *
     * @var string
     */
    private $status;

    /**
     * Construtor da classe
     *
     * @param string $status
     */
    public function __construct(
        string $status
    ) {
        $this->status = $status;
    }

    /**
     * Retorna o valor do status
     *
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }
}
