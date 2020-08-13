<?php

/**
 * Este código faz parte do pacote do SIGEP das aplicações Live eCommerce.
 * (c) Live eCommerce <dev@liveecommerce.com.br>
 *
 * @version 1.0.0
 * @since 1.0.0 criação do pacote live-sigep
 */

namespace Live\Sigep\Barcode\Application\Service;

/**
 * Requisição do serviço de geração de código de barras
 *
 * @package Live\Sigep\Barcode\Application\Service
 */
class GenerateBarcodeRequest
{
    /**
     * Nome do arquivo
     *
     * @var string
     */
    private $name;

    /**
     * Dados
     *
     * @var string
     */
    private $data;

    /**
     * Formato do código de barras
     *
     * @var string
     */
    private $format;

    /**
     * Largura
     *
     * @var float
     */
    private $width;

    /**
     * Altura
     *
     * @var float
     */
    private $height;

    /**
     * Contrutor da classe
     *
     * @param string $name
     * @param string $data
     * @param string $format
     * @param float $width
     * @param float $height
     */
    public function __construct(
        string $name,
        string $data,
        string $format,
        float $width,
        float $height
    ) {
        $this->data = $data;
        $this->format = $format;
        $this->width = $width;
        $this->height = $height;
        $this->name = $name;
    }

    /**
     * Retorna o valor dos dados
     *
     * @return string
     */
    public function getData(): string
    {
        return $this->data;
    }

    /**
     * Retorna o valor do formato
     *
     * @return string
     */
    public function getFormat(): string
    {
        return $this->format;
    }

    /**
     * Retorna o valor da largura
     *
     * @return float
     */
    public function getWidth(): float
    {
        return $this->width;
    }

    /**
     * Retorna o valor da altura
     *
     * @return float
     */
    public function getHeight(): float
    {
        return $this->height;
    }

    /**
     * Retorna o valor do nome do arquivo
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }
}
