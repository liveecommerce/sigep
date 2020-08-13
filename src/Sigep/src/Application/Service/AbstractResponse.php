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
 * Resposta abstrata de serviços de aplicação
 *
 * @package Live\Sigep\Sigep\Application\Service
 */
abstract class AbstractResponse
{
    /**
     * Sucesso na execução do serviço
     *
     * @var boolean
     */
    protected $success;

    /**
     * Lista de errors retornados pelo serviço
     *
     * @var array
     */
    protected $errors;

    /**
     * Construtor da classe
     */
    public function __construct()
    {
        $this->success = true;
        $this->errors = [];
    }

    /**
     * Marca o serviço como sucedido
     *
     * @return self
     */
    public function succeed(): self
    {
        $this->success = true;
        return $this;
    }

    /**
     * Marca o serviço como não-sucedido
     *
     * @param array $errors
     * @return self
     */
    public function fail(array $errors = []): self
    {
        $this->success = false;
        $this->errors = $errors;
        return $this;
    }

    /**
     * Retorna os errors da execução do serviço
     *
     * @return array
     */
    public function getErrors(): array
    {
        return $this->errors;
    }

    /**
     * Verifica se o serviço foi sucedido
     *
     * @return boolean
     */
    public function succeeded(): bool
    {
        return $this->success === true;
    }

    /**
     * Verifica se o serviço falhou
     *
     * @return boolean
     */
    public function failed(): bool
    {
        return $this->success !== true;
    }
}
