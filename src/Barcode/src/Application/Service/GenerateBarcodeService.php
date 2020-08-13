<?php

/**
 * Este código faz parte do pacote do SIGEP das aplicações Live eCommerce.
 * (c) Live eCommerce <dev@liveecommerce.com.br>
 *
 * @version 1.0.0
 * @since 1.0.0 criação do pacote live-sigep
 */

namespace Live\Sigep\Barcode\Application\Service;

use TCPDFBarcode;
use TCPDF2DBarcode;

/**
 * Serviço de geração de código de barras
 * 
 * @package Live\Sigep\Barcode\Application\Service
 */
class GenerateBarcodeService
{
    /**
     * Constante do formato de datamatrix
     */
    const DATAMATRIX = 'DATAMATRIX';

    /**
     * Executa o serviço
     *
     * @param GenerateBarcodeRequest $request
     * @return GenerateBarcodeResponse
     */
    public function __invoke(GenerateBarcodeRequest $request): GenerateBarcodeResponse
    {
        $response = new GenerateBarcodeResponse();

        if ($request->getFormat() == self::DATAMATRIX) {
            $barcodeobj = new TCPDF2DBarcode($request->getData(), $request->getFormat());
        } else {
            $barcodeobj = new TCPDFBarcode($request->getData(), $request->getFormat());
        }

        $barcode = $barcodeobj->getBarcodePngData($request->getHeight(), $request->getWidth(), [2,0,0]);

        $data['barcode'] = $barcode;
        $response->setData($data);

        return $response->succeed();
    }
}
