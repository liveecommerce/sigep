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
 * Serviços do cartão de postagem
 *
 * @package Live\Sigep\PostCard\Domain\Model
 */
class PostCardService
{
    /**
     * Identificação
     *
     * @var int
     */
    private $id;

    /**
     * Código de serviço
     *
     * @var string
     */
    private $serviceCode;

    /**
     * Descrição
     *
     * @var string
     */
    private $description;

    /**
     * Quantidade de encomendas no serviço
     * 
     * @var integer
     */
    private $packagesQuantity;

    /**
     * Construtor do objeto
     *
     * @param integer $id
     * @param string $serviceCode
     * @param string $description
     */
    public function __construct(
        int $id,
        string $serviceCode,
        string $description
    ) {
        $this->id = $id;
        $this->serviceCode = $serviceCode;
        $this->description = $description;
    }

    /**
     * Retorna o valor de identificação
     *
     * @return integer
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Retorna o valor do código de serviço
     *
     * @return string
     */
    public function getServiceCode(): string
    {
        return $this->serviceCode;
    }

    /**
     * Retorna o valor da descrição
     *
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * Define o valor da quantidade de encomendas
     *
     * @param integer $packagesQuantity
     * @return self
     */
    public function setPackagesQuantity(int $packagesQuantity): self
    {
        $this->packagesQuantity = $packagesQuantity;
        return $this;
    }

    /**
     * Retorna o valor da quantidade de encomendas
     *
     * @return integer|null
     */
    public function getPackagesQuantity(): ?int
    {
        return $this->packagesQuantity;
    }
}
