<?php

/**
 * Este código faz parte do pacote do SIGEP das aplicações Live eCommerce.
 * (c) Live eCommerce <dev@liveecommerce.com.br>
 *
 * @version 1.0.0
 * @since 1.0.0 criação do pacote live-sigep
 */

namespace Live\Sigep\ShippingLabel\Application\Service;

use Live\Sigep\Sigep\Application\Service\AbstractUserDataRequest;

/**
 * Requisição do serviço de busca de etiquetas
 *
 * @package Live\Sigep\ShippingLabel\Application\Service
 */
class GetShippingLabelsRequest extends AbstractUserDataRequest
{
    /**
     * Identificação do serviço
     *
     * @var string
     */
    private $serviceId;

    /**
     * Tipo de destinatário
     *
     * @var string
     */
    private $receiverType;

    /**
     * Cnpj do remetente
     *
     * @var string
     */
    private $cnpj;

    /**
     * Quantidade de etiquetas
     *
     * @var int
     */
    private $quantityLabels;

    /**
     * Construtor da classe
     *
     * @param string $user
     * @param string $password
     * @param string $serviceId
     * @param string $receiverType
     * @param string $cnpj
     * @param integer $quantityLabels
     */
    public function __construct(
        string $user,
        string $password,
        string $serviceId,
        string $receiverType,
        string $cnpj,
        int $quantityLabels
    ) {
        $this->user = $user;
        $this->password = $password;
        $this->serviceId = $serviceId;
        $this->receiverType = $receiverType;
        $this->cnpj = $cnpj;
        $this->quantityLabels = $quantityLabels;
    }

    /**
     * Retorna o valor da identificação do serviço
     *
     * @return string
     */
    public function getServiceId(): string
    {
        return $this->serviceId;
    }

    /**
     * Retorna o tipo de destinatário
     *
     * @return string
     */
    public function getReceiverType(): string
    {
        return $this->receiverType;
    }

    /**
     * Retorna o cnpj
     *
     * @return string
     */
    public function getCnpj(): string
    {
        return $this->cnpj;
    }

    /**
     * Retorna a quantidade de etiquetas
     *
     * @return integer
     */
    public function getQuantityLabels(): int
    {
        return $this->quantityLabels;
    }
}
