<?php

/**
 * Este código faz parte do pacote do SIGEP das aplicações Live eCommerce.
 * (c) Live eCommerce <dev@liveecommerce.com.br>
 *
 * @version 1.0.0
 * @since 1.0.0 criação do pacote live-sigep
 */

namespace Live\Sigep\PostCard\Application\Service;

use Live\Sigep\PostCard\Domain\Model\PostCardAvaliableServices;
use Live\Sigep\Sigep\Application\Service\AbstractObjectResponse;

/**
 * Resposta do serviço de verificação dos serviços disponiveis para o cartão de postagem
 *
 * @package Live\Sigep\PostCard\Application\Service
 */
class GetPostCardAvaliableServicesResponse extends AbstractObjectResponse
{
    /**
     * {@inheritDoc}
     */
    protected function isObjectValid($object): bool
    {
        return $object instanceof PostCardAvaliableServices;
    }
}
