<?php

/**
 * Este código faz parte do pacote do SIGEP das aplicações Live eCommerce.
 * (c) Live eCommerce <dev@liveecommerce.com.br>
 *
 * @version 1.0.0
 * @since 1.0.0 criação do pacote live-sigep
 */

namespace Live\Sigep\Sigep\Application\Service;

/**
 * Requisição abstrada dos dados do usuário
 *
 * @package Live\Sigep\Sigep\Application\Service
 */
abstract class AbstractUserDataRequest
{
    /**
     * Usuário
     *
     * @var string
     */
    protected $user;

    /**
     * Senha
     *
     * @var string
     */
    protected $password;

    /**
     * Ambiente de desenvolvimento
     *
     * @var boolean
     */
    protected $sandbox;

    /**
     * Retorna o valor do usuário
     *
     * @return string
     */ 
    public function getUser(): string
    {
        return $this->user;
    }

    /**
     * Retorna o valor da senha
     *
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * Define o valor do ambiente de desenvolvimento
     *
     * @param boolean $sandbox
     * @return self
     */
    public function setSandbox(bool $sandbox): self
    {
        $this->sandbox = $sandbox;
        return $this;
    }

    /**
     * Retorna o valor do ambiente de desenvolvimento
     *
     * @return boolean|null
     */
    public function getSandbox(): ?bool
    {
        return $this->sandbox;
    }
}
