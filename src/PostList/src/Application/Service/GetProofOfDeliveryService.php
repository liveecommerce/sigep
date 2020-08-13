<?php

/**
 * Este código faz parte do pacote do SIGEP das aplicações Live eCommerce.
 * (c) Live eCommerce <dev@liveecommerce.com.br>
 *
 * @version 1.0.0
 * @since 1.0.0 criação do pacote live-sigep
 */

namespace Live\Sigep\PostList\Application\Service;

use Live\Sigep\Sigep\Application\Service\AbstractGeneratePdf;
use Live\Sigep\Barcode\Application\Service\GenerateBarcodeRequest;
use Live\Sigep\Barcode\Application\Service\GenerateBarcodeService;
use Live\Sigep\Barcode\Application\Service\GenerateBarcodeResponse;

/**
 * Serviço de geração de aviso de recebimento
 *
 * @package Live\Sigep\PostList\Application\Service
 */
class GetProofOfDeliveryService extends AbstractGeneratePdf
{
    const STATIC_PATH = __DIR__ . '/../../Domain/Static/';

    /**
     * Executa o serviço
     *
     * @param GetProofOfDeliveryRequest $request
     * @return GetProofOfDeliveryResponse
     */
    public function __invoke(array $request): GetProofOfDeliveryResponse
    {
        $response = new GetProofOfDeliveryResponse();

        $this->clearAllImages(current($request)->getContract());

        $html = '';
        foreach ($request as $data) {
            $html .= $this->generateHtml($data);
        }

        $this->addHtml($html);
        $this->generatePdf("aviso de recebimento");

        return $response->succeed();
    }

    /**
     * Exclui todas as imagens antigas dos avisos de recebimento
     *
     * @param string $data
     * @return void
     */
    private function clearAllImages(string $data): void
    {
        $images = glob(self::STATIC_PATH . "/Image/shipping-{$data}*.png");

        array_map(function($link) {
            return unlink($link);
        }, $images);
    }

    /**
     * Gera o código de barras
     *
     * @param string $name
     * @param string $data
     * @param string $format
     * @param float $height
     * @param float $width
     * @return GenerateBarcodeResponse
     */
    private function getBarcode(
        string $name,
        string $data,
        string $format,
        float $height,
        float $width
    ): GenerateBarcodeResponse {
        $request = new GenerateBarcodeRequest($name, $data, $format, $height, $width);

        $service = new GenerateBarcodeService();
        $response = $service($request);

        return $response;
    }

    /**
     * Gera o html do aviso de recebimento
     *
     * @param GetProofOfDeliveryRequest $data
     * @return string
     */
    private function generateHtml(GetProofOfDeliveryRequest $data): string
    {
        $html = file_get_contents(self::STATIC_PATH . '/Template/proofOfDelivery.tpl');

        $html = str_replace("{{contract}}", $data->getContract(), $html);

        $shippingLabel = $data->getPostalObject()->getShippingLabel()->getLabel();
        $shippingLabelBarcode = $this->getBarcode(
            'shipping',
            $shippingLabel,
            'C128',
            45,
            1.8
        );

        $urlImage = self::STATIC_PATH . "/Image/shipping-{$data->getContract()}-{$shippingLabel}.png";
        file_put_contents($urlImage, $shippingLabelBarcode->getData()['barcode']);

        $html = str_replace("{{shippingLabel}}", $shippingLabel, $html);
        $html = str_replace("{{shippingBarcode}}", $urlImage, $html);
        $html = str_replace('{{correiosLogo}}', self::STATIC_PATH . '/Image/correios-logo.png', $html);

        $receiverAddress = $data->getPostalObject()->getAddress();
        $html = str_replace("{{receiverName}}", $data->getPostalObject()->getReceiverName(), $html);
        $html = str_replace("{{receiverStreet}}", $receiverAddress->getStreet(), $html);
        $html = str_replace("{{receiverNumber}}", $receiverAddress->getNumber(), $html);
        $html = str_replace("{{receiverComplement}}", $receiverAddress->getComplement(), $html);
        $html = str_replace("{{receiverDistrict}}", $receiverAddress->getDistrict(), $html);
        $html = str_replace("{{receiverZipcode}}", $receiverAddress->getZipcode(), $html);
        $html = str_replace("{{receiverCity}}", $receiverAddress->getCity(), $html);
        $html = str_replace("{{receiverState}}", $receiverAddress->getState(), $html);

        $senderAddress = $data->getSenderAddress();
        $html = str_replace("{{senderName}}", $data->getSenderName(), $html);
        $html = str_replace("{{senderStreet}}", $senderAddress->getStreet(), $html);
        $html = str_replace("{{senderNumber}}", $senderAddress->getNumber(), $html);
        $html = str_replace("{{senderComplement}}", $senderAddress->getComplement(), $html);
        $html = str_replace("{{senderDistrict}}", $senderAddress->getDistrict(), $html);
        $html = str_replace("{{senderZipcode}}", $senderAddress->getZipcode(), $html);
        $html = str_replace("{{senderCity}}", $senderAddress->getCity(), $html);
        $html = str_replace("{{senderState}}", $senderAddress->getState(), $html);

        return $html;
    }
}
