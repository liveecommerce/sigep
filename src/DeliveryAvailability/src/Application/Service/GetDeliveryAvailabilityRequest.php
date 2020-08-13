<?php

/**
 * Este código faz parte do pacote do SIGEP das aplicações Live eCommerce.
 * (c) Live eCommerce <dev@liveecommerce.com.br>
 *
 * @version 1.0.0
 * @since 1.0.0 criação do pacote live-sigep
 */

namespace Live\Sigep\DeliveryAvailability\Application\Service;

use Live\Sigep\Sigep\Application\Service\AbstractUserDataRequest;

/**
 * Requisição do serviço de busca de disponibilidade de envio
 *
 * @package Live\Sigep\DeliveryAvailability\Application\Service
 */
class GetDeliveryAvailabilityRequest extends AbstractUserDataRequest
{
    /**
     * Código administrativo
     *
     * @var string
     */
    private $administrativeCode;

    /**
     * Código de serviço
     *
     * @var string
     */
    private $serviceCode;

    /**
     * Código postal de origem
     *
     * @var string
     */
    private $zipCodeOrigin;

    /**
     * Código postal de destino
     *
     * @var string
     */
    private $zipCodeDestiny;

    /**
     * Construtor da classe
     *
     * @param string $user
     * @param string $password
     * @param string $administrativeCode
     * @param string $serviceCode
     * @param string $zipCodeOrigin
     * @param string $zipCodeDestiny
     */
    public function __construct(
        string $user,
        string $password,
        string $administrativeCode,
        string $serviceCode,
        string $zipCodeOrigin,
        string $zipCodeDestiny
    ) {
        $this->user = $user;
        $this->password = $password;
        $this->administrativeCode = $administrativeCode;
        $this->serviceCode = $serviceCode;
        $this->zipCodeOrigin = $zipCodeOrigin;
        $this->zipCodeDestiny = $zipCodeDestiny;
    }

    /**
     * Retorna o valor do código administrativo
     *
     * @return string
     */
    public function getAdministrativeCode(): string
    {
        return $this->administrativeCode;
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
     * Retona o valor do código postal de origem
     *
     * @return string
     */
    public function getZipCodeOrigin(): string
    {
        return $this->zipCodeOrigin;
    }

    /**
     * Retorna o valor do código postal de destino
     *
     * @return string
     */
    public function getZipCodeDestiny(): string
    {
        return $this->zipCodeDestiny;
    }
}
