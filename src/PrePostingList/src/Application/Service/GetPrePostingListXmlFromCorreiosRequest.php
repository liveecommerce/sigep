<?php

/**
 * Este código faz parte do pacote do SIGEP das aplicações Live eCommerce.
 * (c) Live eCommerce <dev@liveecommerce.com.br>
 *
 * @version 1.0.0
 * @since 1.0.0 criação do pacote live-sigep
 */

namespace Live\Sigep\PrePostingList\Application\Service;

use Live\Sigep\Sigep\Application\Service\AbstractUserDataRequest;

/**
 * Requisição do serviço de busca do xml da pré lista de postagem
 *
 * @package Live\Sigep\PrePostingList\Application\Service
 */
class GetPrePostingListXmlFromCorreiosRequest extends AbstractUserDataRequest
{
    /**
     * Número da pré lista de postagem
     *
     * @var integer
     */
    private $plpNumber;

    /**
     * Construtor da classe
     *
     * @param integer $plpNumber
     * @param string $user
     * @param string $password
     */
    public function __construct(
        string $user,
        string $password,
        int $plpNumber
    ) {
        $this->plpNumber = $plpNumber;
        $this->user = $user;
        $this->password = $password;
    }

    /**
     * Retorna o valor da pré lista de postagem
     *
     * @return integer
     */
    public function getPlpNumber(): int
    {
        return $this->plpNumber;
    }
}
