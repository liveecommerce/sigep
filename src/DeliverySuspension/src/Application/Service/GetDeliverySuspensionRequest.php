<?php

/**
 * Este código faz parte do pacote do SIGEP das aplicações Live eCommerce.
 * (c) Live eCommerce <dev@liveecommerce.com.br>
 *
 * @version 1.0.0
 * @since 1.0.0 criação do pacote live-sigep
 */

namespace Live\Sigep\DeliverySuspension\Application\Service;

use Live\Sigep\PrePostingList\Domain\Model\PrePostingList;
use Live\Sigep\ShippingLabel\Domain\Model\ShippingLabel;
use Live\Sigep\Sigep\Application\Service\AbstractUserDataRequest;

/**
 * Requisição do serviço de suspensão de envio de encomenda
 *
 * @package Live\Sigep\DeliverySuspension\Application\Service
 */
class GetDeliverySuspensionRequest extends AbstractUserDataRequest
{
    /**
     * Etiqueta
     *
     * @var ShippingLabel
     */
    private $shippingLabel;

    /**
     * Pré-lista de postagem
     *
     * @var PrePostingList
     */
    private $prePostingList;

    /**
     * Contrutor da classe
     *
     * @param ShippingLabel $shippingLabel
     * @param PrePostingList $prePostingList
     * @param string $user
     * @param string $password
     */
    public function __construct(
        string $user,
        string $password,
        ShippingLabel $shippingLabel,
        PrePostingList $prePostingList
    ) {
        $this->shippingLabel = $shippingLabel;
        $this->prePostingList = $prePostingList;
        $this->user = $user;
        $this->password = $password;
    }

    /**
     * Retorna o valor da pré-lista de postagem
     *
     * @return PrePostingList
     */
    public function getPrePostingList(): PrePostingList
    {
        return $this->prePostingList;
    }

    /**
     * Retorna o valor da etiqueta
     *
     * @return ShippingLabel
     */
    public function getShippingLabel(): ShippingLabel
    {
        return $this->shippingLabel;
    }
}
