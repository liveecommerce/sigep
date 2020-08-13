<?php

/**
 * Este código faz parte do pacote do SIGEP das aplicações Live eCommerce.
 * (c) Live eCommerce <dev@liveecommerce.com.br>
 *
 * @version 1.0.0
 * @since 1.0.0 criação do pacote live-sigep
 */

namespace Live\Sigep\DeliveryAvailability\Domain\Model;

/**
 * Disponibilidade de envio
 *
 * @package Live\Sigep\DeliveryAvailability\Domain\Model
 */
class DeliveryAvailability
{
    /**
     * Id de retorno dos correios
     *
     * @var string
     */
    private $id;

    /**
     * Mensagem de retorno
     *
     * @var string
     */
    private $message;

    /**
     * Construtor da classe
     *
     * @param string $id
     * @param string $message
     */
    public function __construct(
        string $id,
        string $message
    ) {
        $this->id = $id;
        $this->message = $message;
    }

    /**
     * Retorna o valor do id
     *
     * @return string|null
     */
    public function getId(): ?string
    {
        return $this->id;
    }

    /**
     * Retorna o valor da mensagem
     *
     * @return string|null
     */
    public function getMessage(): ?string
    {
        return $this->message;
    }
}
