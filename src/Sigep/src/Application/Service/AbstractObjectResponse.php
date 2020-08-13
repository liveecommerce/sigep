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
 * Resposta abstrata de serviços de aplicação que resulta em objeto
 *
 * @package Live\Sigep\Sigep\Application\Service
 */
abstract class AbstractObjectResponse extends AbstractResponse
{
    /**
     * Lista de resultados
     *
     * @var object
     */
    private $object;

    /**
     * Define os dados resultantes da execução do serviço
     *
     * @param object $object
     * @return self
     * @throws \InvalidArgumentException
     */
    public function setObject($object): self
    {
        if (is_object($object) && !$this->isObjectValid($object)) {
            throw new \InvalidArgumentException(
                sprintf('Invalid object type supplied (%s)', get_class($object))
            );
        }

        if (!is_object($object) && $object !== null) {
            throw new \InvalidArgumentException('Argument 1 must be an object or null');
        }

        $this->object = $object;
        return $this;
    }

    /**
     * Retorna os dados obtidos com a execução do serviço
     *
     * @return object|null
     */
    public function getObject()
    {
        return $this->object;
    }

    /**
     * Verifica se o tipo do objeto é compatível com a classe de resposta
     *
     * @param object $object
     * @return boolean
     */
    abstract protected function isObjectValid($object): bool;
}
