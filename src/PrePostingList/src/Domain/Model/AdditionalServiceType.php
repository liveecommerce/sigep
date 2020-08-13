<?php

/**
 * Este código faz parte do pacote do SIGEP das aplicações Live eCommerce.
 * (c) Live eCommerce <dev@liveecommerce.com.br>
 *
 * @version 1.0.0
 * @since 1.0.0 criação do pacote live-sigep
 */

namespace Live\Sigep\PrePostingList\Domain\Model;

/**
 * Tipos dos serviços adicionais
 *
 * @package Live\Sigep\PrePostingList\Domain\Model
 */
class AdditionalServiceType
{
    const PROOFOFDELIVERY = '001';
    const DELIVERYTONEIGHBOR = '002';
    const NATIONALOWNHAND = '011';
    const ELECTION = '017';
    const PREMIUMANDEXPRESS = '019';
    const NATIONALREGISTRATION = '025';
    const REGISTEREDLETTER = '035';
    const LARGEFORMATS = '057';
    const NATIONALSTANDARD = '064';
    const MINIPAC = '065';
}
