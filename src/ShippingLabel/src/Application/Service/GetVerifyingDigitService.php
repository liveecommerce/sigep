<?php

/**
 * Este código faz parte do pacote do SIGEP das aplicações Live eCommerce.
 * (c) Live eCommerce <dev@liveecommerce.com.br>
 *
 * @version 1.0.0
 * @since 1.0.0 criação do pacote live-sigep
 */

namespace Live\Sigep\ShippingLabel\Application\Service;

use Live\Sigep\ShippingLabel\Domain\Model\ShippingLabel;

/**
 * Serviço de geração de digito verificador das etiquetas
 *
 * @package Live\Sigep\ShippingLabel\Application\Service
 */
class GetVerifyingDigitService
{
    /**
     * Executa o serviço
     *
     * @param ShippingLabel $shippingLabel
     * @return ShippingLabel
     */
    public function __invoke(ShippingLabel $shippingLabel): ShippingLabel
    {
        $label = $shippingLabel->getLabel();

        $prefix = substr($label, 0, 2);
        $number = substr($label, 2, 8);
        $suffix = trim(substr($label, 10));

        $returnLabel = $number;

        $verifyingDigit = null;

        $multipliers = [8, 6, 4, 2, 3, 5, 9, 7];
        $sum = 0;

        $countLabel = strlen($label);
        $countNumber = strlen($number);

        if ($countLabel < 12) {
            $shippingLabel = new ShippingLabel('');

            return $shippingLabel;
        } elseif ($countNumber < 8 && $countLabel == 12) {
            $zeros = '';
            $difference = 8 - $countNumber;

            str_pad($zeros, $difference, "0");

            $returnLabel = $zeros . $number; 
        } else {
            $returnLabel = substr($number, 0, 8);
        }

        for ($i = 0; $i < 8; $i++) {
            $sum += ((int) (substr($returnLabel, $i, 1))) * $multipliers[$i];
        }

        $rest = $sum % 11;

        if ($rest == 0) {
            $verifyingDigit = '5';
        } elseif ($rest == 1) {
            $verifyingDigit = '0';
        } else {
            $verifyingDigit = (string) (11 - $rest);
        }

        $returnLabel .= $verifyingDigit;
        $returnLabel = $prefix . $returnLabel . $suffix;

        $shippingLabel = new ShippingLabel($returnLabel);

        return $shippingLabel;
    }
}
