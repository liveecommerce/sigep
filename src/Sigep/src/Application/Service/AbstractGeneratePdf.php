<?php

/**
 * Este código faz parte do pacote do SIGEP das aplicações Live eCommerce.
 * (c) Live eCommerce <dev@liveecommerce.com.br>
 *
 * @version 1.0.0
 * @since 1.0.0 criação do pacote live-sigep
 */

namespace Live\Sigep\Sigep\Application\Service;

use \Spipu\Html2Pdf\Html2Pdf;

/**
 * Geração abstrata de Pdf
 *
 * @package Live\Sigep\Sigep\Application\Service
 */
abstract class AbstractGeneratePdf
{
    /**
     * Dados do pdf
     *
     * @var Html2Pdf
     */
    protected $pdf;

    const PUBLIC_FOLDER = '../../../../public/';

    /**
     * Construtor da classe
     */
    public function __construct(string $orientation = 'P')
    {
        $this->pdf = new Html2Pdf($orientation, 'A4', 'pt', true, 'UTF-8', [4, 4, 6, 3]);
    }

    /**
     * Adiciona o html no pdf
     *
     * @param string $html
     * @return self
     */
    public function addHtml(string $html): self
    {
        $this->pdf->writeHTML($html);
        return $this;
    }

    /**
     * Gera o pdf
     *
     * @param string $name
     * @return string
     */
    public function generatePdf(string $name = "pdf"): string
    {
        $document = $this->pdf->output($name . '.pdf', 'D');
        return $document;
    }
}