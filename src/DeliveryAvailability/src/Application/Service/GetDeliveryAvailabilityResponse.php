<?php

/**
 * Este código faz parte do pacote do SIGEP das aplicações Live eCommerce.
 * (c) Live eCommerce <dev@liveecommerce.com.br>
 *
 * @version 1.0.0
 * @since 1.0.0 criação do pacote live-sigep
 */

namespace Live\Sigep\DeliveryAvailability\Application\Service;

use Live\Sigep\DeliveryAvailability\Domain\Model\DeliveryAvailability;
use Live\Sigep\Sigep\Application\Service\AbstractObjectResponse;

/**
 * Resposta do serviço de busca de disponibilidade de envio
 *
 * @package Live\Sigep\DeliveryAvailability\Application\Service
 */
class GetDeliveryAvailabilityResponse extends AbstractObjectResponse
{
    /**
     * {@inheritDoc}
     */
    protected function isObjectValid($object): bool
    {
        return $object instanceof DeliveryAvailability;
    }
}
