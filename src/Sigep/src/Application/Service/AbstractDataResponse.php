<?php

/**
 * Este código faz parte do pacote do SIGEP das aplicações Live eCommerce.
 * (c) Live eCommerce <dev@liveecommerce.com.br>
 *
 * @version 1.0.0
 * @since 1.0.0 criação do pacote live-sigep
 */

namespace Live\Sigep\Sigep\Application\Service;

/**
 * Resposta abstrata de serviços de aplicação
 *
 * @package Live\Sigep\Sigep\Application\Service
 */
abstract class AbstractDataResponse extends AbstractResponse
{
    /**
     * Lista de resultados
     *
     * @var array
     */
    private $data;

    /**
     * Define os dados resultantes da execução do serviço
     *
     * @param array $data
     * @return self
     */
    public function setData(array $data): self
    {
        $this->data = $data;
        return $this;
    }

    /**
     * Retorna os dados obtidos com a execução do serviço
     *
     * @return array
     */
    public function getData(): array
    {
        return $this->data ?: [];
    }
}
