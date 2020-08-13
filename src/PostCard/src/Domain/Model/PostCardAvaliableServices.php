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
 * Serviços disponiveis do cartão de postagem
 *
 * @package Live\Sigep\PostCard\Domain\Model
 */
class PostCardAvaliableServices
{
    /**
     * Número do cartão de postagem
     *
     * @var string
     */
    private $postCardNumber;

    /**
     * Código administrativo
     *
     * @var string
     */
    private $administrativeCode;

    /**
     * Cnpj
     *
     * @var string
     */
    private $cnpj;

    /**
     * Serviços de postagem
     *
     * @var array
     */
    private $services = [];

    /**
     * Construtor da classe
     *
     * @param string $administrativeCode
     * @param string $postCardNumber
     * @param string $cnpj
     */
    public function __construct(
        string $administrativeCode,
        string $postCardNumber,
        string $cnpj
    ) {
        $this->postCardNumber = $postCardNumber;
        $this->administrativeCode = $administrativeCode;
        $this->cnpj = $cnpj;
    }

    /**
     * Retorna o valor do número do cartão de postagem
     *
     * @return string
     */
    public function getPostCardNumber(): string
    {
        return $this->postCardNumber;
    }

    /**
     * Retorno do valor do código administrativo
     *
     * @return string
     */
    public function getAdministrativeCode(): string
    {
        return $this->administrativeCode;
    }

    /**
     * Retorno do valor do cnpj
     *
     * @return string
     */
    public function getCnpj(): string
    {
        return $this->cnpj;
    }

    /**
     * Retorna o valor dos serviços de postagem
     *
     * @return array
     */
    public function getServices(): array
    {
        return $this->services;
    }

    /**
     * Adiciona um serviço de postagem
     *
     * @param PostCardService $service
     * @return self
     */
    public function addService(PostCardService $service): self
    {
        $this->services[$service->getServiceCode()] = $service;
        return $this;
    }
}
