<?php

/**
 * Este código faz parte do pacote do SIGEP das aplicações Live eCommerce.
 * (c) Live eCommerce <dev@liveecommerce.com.br>
 *
 * @version 1.0.0
 * @since 1.0.0 criação do pacote live-sigep
 */

namespace Live\Sigep\PrePostingList\Domain\Model;

/**
 * Pre-lista de postagem
 *
 * @package Live\Sigep\PrePostingList\Domain\Model
 */
class PrePostingList
{
    /**
     * Identificação
     *
     * @var string
     */
    private $id;

    /**
     * Construtor da classe
     *
     * @param integer $id
     */
    public function __construct(
        string $id
    ) {
        $this->id = $id;
    }

    /**
     * Retorna a identificação
     *
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }
}
