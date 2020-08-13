<?php

/**
 * Este código faz parte do pacote do SIGEP das aplicações Live eCommerce.
 * (c) Live eCommerce <dev@liveecommerce.com.br>
 *
 * @version 1.0.0
 * @since 1.0.0 criação do pacote live-sigep
 */

namespace Live\Sigep\Address\Application\Service;

use Live\Sigep\Sigep\Application\Service\AbstractUserDataRequest;

/**
 * Requisição do serviço de busca de endereço por código postal
 *
 * @package Live\Sigep\Address\Application\Service
 */
class GetAddressByZipCodeRequest extends AbstractUserDataRequest
{
    /**
     * Código postal
     *
     * @var string
     */
    private $zipCode;

    /**
     * Construtor da classe
     *
     * @param string $zipCode
     */
    public function __construct(string $zipCode)
    {
        $this->zipCode = $zipCode;
    }

    /**
     * Retorna o código postal
     *
     * @return string
     */
    public function getZipCode(): string
    {
        return $this->zipCode;
    }
}
