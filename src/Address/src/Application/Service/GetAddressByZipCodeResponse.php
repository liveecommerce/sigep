<?php

/**
 * Este código faz parte do pacote do SIGEP das aplicações Live eCommerce.
 * (c) Live eCommerce <dev@liveecommerce.com.br>
 *
 * @version 1.0.0
 * @since 1.0.0 criação do pacote live-sigep
 */

namespace Live\Sigep\Address\Application\Service;

use Live\Sigep\Address\Domain\Model\Address;
use Live\Sigep\Sigep\Application\Service\AbstractObjectResponse;

/**
 * Resposta do serviço de busca de endereço por código postal
 *
 * @package Live\Sigep\Address\Application\Service
 */
class GetAddressByZipCodeResponse extends AbstractObjectResponse
{
    /**
     * {@inheritDoc}
     */
    protected function isObjectValid($object): bool
    {
        return $object instanceof Address;
    }
}
