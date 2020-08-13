<?php

/**
 * Este código faz parte do pacote do SIGEP das aplicações Live eCommerce.
 * (c) Live eCommerce <dev@liveecommerce.com.br>
 *
 * @version 1.0.0
 * @since 1.0.0 criação do pacote live-sigep
 */

namespace Live\Sigep\ShippingLabel\Domain\Model;

/**
 * Etiqueta
 *
 * @package Live\Sigep\ShippingLabel\Domain\Model
 */
class ShippingLabel
{
    /**
     * Etiqueta dos Correios
     *
     * @var string
     */
    private $label;

    /**
     * Construtor da classe
     *
     * @param string $label
     */
    public function __construct(
        string $label
    ) {
        $this->label = $label;
    }

    /**
     * Retorna a etiqueta
     *
     * @return string
     */
    public function getLabel(): string
    {
        return $this->label;
    }

    /**
     * Retorna a etiqueta sem o digito verificador
     *
     * @return string
     */
    public function getShippingLabelsWithoutVerifyingDigit(): string
    {
        $label = substr($this->label, 0, 10);
        $suffix = substr($this->label, 11, 12);

        $shippingLabelString = $label . $suffix;

        return $shippingLabelString;
    }
}
