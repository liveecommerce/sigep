<?php

/**
 * Este código faz parte do pacote do SIGEP das aplicações Live eCommerce.
 * (c) Live eCommerce <dev@liveecommerce.com.br>
 *
 * @version 1.0.0
 * @since 1.0.0 criação do pacote live-sigep
 */

namespace Live\Sigep\Address\Application\Service;

use Live\Sigep\Address\Domain\Model\Address;

/**
 * Serviço de verificação de código postal
 *
 * @package Live\Sigep\Address\Application\Service
 */
class VerifyingZipCodeService
{
    /**
     * Executa o serviço
     *
     * @param Address $address
     * @return VerifyingZipCodeResponse
     */
    public function __invoke(Address $address): VerifyingZipCodeResponse
    {
        $response = new VerifyingZipCodeResponse();

        $verifyingZipCode = 0;
        $zipCode = $address->getZipCode();
        $length = strlen($zipCode);

        $zipCodeSum = 0;
        for ($i = 0; $i < $length; $i++) {
            $zipCodeSum += (int) $zipCode[$i];
        }

        $multipliers = [10, 20, 30, 40, 50, 60, 70, 80, 90, 100];
        if ($zipCodeSum % 10 != 0) {
            foreach ($multipliers as $multiplier) {
                if ($zipCodeSum > $multiplier) {
                    continue;
                }

                $verifyingZipCode = $multiplier - $zipCodeSum;
                break;
            }
        }

        $data['verifyingZipCode'] = $verifyingZipCode;

        $response->setData($data);

        return $response->succeed();
    }
}
