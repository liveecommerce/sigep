<?php

/**
 * Este código faz parte do pacote do SIGEP das aplicações Live eCommerce.
 * (c) Live eCommerce <dev@liveecommerce.com.br>
 *
 * @version 1.0.0
 * @since 1.0.0 criação do pacote live-sigep
 */

namespace Live\Sigep\Address\Domain\Model;

/**
 * Endereço
 *
 * @package Live\Sigep\Address\Domain\Model
 */
class Address
{
    /**
     * Código postal
     *
     * @var string
     */
    private $zipCode;

    /**
     * Rua
     *
     * @var string
     */
    private $street;

    /**
     * Bairro
     *
     * @var string
     */
    private $district;

    /**
     * Cidade
     *
     * @var string
     */
    private $city;

    /**
     * Estado
     *
     * @var string
     */
    private $state;

    /**
     * Complemento
     *
     * @var string
     */
    private $complement;

    /**
     * Complemento adicional
     *
     * @var string
     */
    private $additionalComplement;

    /**
     * Número
     *
     * @var string
     */
    private $number;

    /**
     * Complemento do código postal
     *
     * @var string
     */
    private $zipCodeComplement;

    /**
     * Construtor
     *
     * @param string $zipCode
     * @param string $street
     * @param string $district
     * @param string $city
     * @param string $state
     */
    public function __construct(
        string $zipCode,
        string $street,
        string $district,
        string $city,
        string $state
    ) {
        $this->zipCode = $zipCode;
        $this->street = $street;
        $this->district = $district;
        $this->city = $city;
        $this->state = $state;
    }

    /**
     * Retorna o valor do código postal
     *
     * @return string $zipCode
     */
    public function getZipCode(): string
    {
        return $this->zipCode;
    }

     /**
     * Retona o valor da rua
     *
     * @return string $street
     */
    public function getStreet(): string
    {
        return $this->street;
    }

    /**
     * Define o valor para a rua
     *
     * @param string|null $street
     * @return self
     */
    public function setStreet(?string $street): self
    {
        $this->street = $street;
        return $this;
    }

    /**
     * Retona o valor do bairro
     *
     * @return string $district
     */
    public function getDistrict(): string
    {
        return $this->district;
    }

    /**
     * Define o valor para o bairro
     *
     * @param string|null $district
     * @return self
     */
    public function setDistrict(?string $district): self
    {
        $this->district = $district;
        return $this;
    }

    /**
     * Retona o valor da cidade
     *
     * @return string $city
     */
    public function getCity(): string
    {
        return $this->city;
    }

    /**
     * Define o valor para a cidade
     *
     * @param string|null $city
     * @return self
     */
    public function setCity(?string $city): self
    {
        $this->city = $city;
        return $this;
    }

    /**
     * Retona o valor do estado
     *
     * @return string $state
     */
    public function getState(): string
    {
        return $this->state;
    }

    /**
     * Retona o valor do complemento
     *
     * @return string|null $complement
     */
    public function getComplement(): ?string
    {
        return $this->complement;
    }

    /**
     * Define o valor para o complemento
     *
     * @param string|null $complement
     * @return self
     */
    public function setComplement(?string $complement): self
    {
        $this->complement = $complement;
        return $this;
    }

    /**
     * Retorna o valor do complemento adicional
     *
     * @return string|null $additionalComplement
     */
    public function getAdditionalComplement(): ?string
    {
        return $this->additionalComplement;
    }

    /**
     * Define o valor do complemento adicional
     *
     * @param string|null $additionalComplement
     * @return self
     */
    public function setAdditionalComplement(?string $additionalComplement): self
    {
        $this->additionalComplement = $additionalComplement;
        return $this;
    }

    /**
     * Retorna o valor do número
     *
     * @return string $number
     */
    public function getNumber(): ?string
    {
        return $this->number;
    }

    /**
     * Define o valor do número
     *
     * @param string|null $number
     * @return self
     */
    public function setNumber(?string $number): self
    {
        $this->number = $number;
        return $this;
    }

    /**
     * Retorna o valor do complemento do código postal
     *
     * @return string|null $zipCodeComplement
     */
    public function getZipCodeComplement(): ?string
    {
        return $this->zipCodeComplement;
    }

    /**
     * Define o valor do complemento do código postal
     *
     * @param string|null $zipCodeComplement
     * @return self
     */
    public function setZipCodeComplement(?string $zipCodeComplement): self
    {
        $this->zipCodeComplement = $zipCodeComplement;
        return $this;
    }
}

