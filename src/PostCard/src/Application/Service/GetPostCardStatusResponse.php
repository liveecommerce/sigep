<?php

/**
 * Este código faz parte do pacote do SIGEP das aplicações Live eCommerce.
 * (c) Live eCommerce <dev@liveecommerce.com.br>
 *
 * @version 1.0.0
 * @since 1.0.0 criação do pacote live-sigep
 */

namespace Live\Sigep\PostCard\Application\Service;

use Live\Sigep\PostCard\Domain\Model\PostCardStatus;
use Live\Sigep\Sigep\Application\Service\AbstractObjectResponse;

/**
 * Resposta do serviço de verificação do status do cartão de postagem
 *
 * @package Live\Sigep\PostCard\Application\Service
 */
class GetPostCardStatusResponse extends AbstractObjectResponse
{
    /**
     * {@inheritDoc}
     */
    protected function isObjectValid($object): bool
    {
        return $object instanceof PostCardStatus;
    }
}
