<?php

/**
 * Este código faz parte do pacote do SIGEP das aplicações Live eCommerce.
 * (c) Live eCommerce <dev@liveecommerce.com.br>
 *
 * @version 1.0.0
 * @since 1.0.0 criação do pacote live-sigep
 */

namespace Live\Sigep\PrePostingList\Application\Service;

use Live\Sigep\PrePostingList\Domain\Model\PrePostingList;
use Live\Sigep\Sigep\Application\Service\AbstractObjectResponse;

/**
 * Resposta do serviço de finalização da pré lista de postagem
 *
 * @package Live\Sigep\PrePostingList\Application\Service
 */
class ClosePrePostingListResponse extends AbstractObjectResponse
{
    /**
     * {@inheritDoc}
     */
    protected function isObjectValid($object): bool
    {
        return $object instanceof PrePostingList;
    }
}
