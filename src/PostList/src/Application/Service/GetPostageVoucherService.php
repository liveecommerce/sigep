<?php

/**
 * Este código faz parte do pacote do SIGEP das aplicações Live eCommerce.
 * (c) Live eCommerce <dev@liveecommerce.com.br>
 *
 * @version 1.0.0
 * @since 1.0.0 criação do pacote live-sigep
 */

namespace Live\Sigep\PostList\Application\Service;

use Live\Sigep\Barcode\Application\Service\GenerateBarcodeRequest;
use Live\Sigep\Barcode\Application\Service\GenerateBarcodeService;
use Live\Sigep\Address\Application\Service\VerifyingZipCodeService;
use Live\Sigep\Barcode\Application\Service\GenerateBarcodeResponse;
use Live\Sigep\Sigep\Application\Service\AbstractGeneratePdf;

/**
 * Serviço de geração do voucher de postagem
 *
 * @package Live\Sigep\PostList\Application\Service
 */
class GetPostageVoucherService extends AbstractGeneratePdf
{
    const STATIC_PATH = __DIR__ . '/../../Domain/Static/';

    /**
     * Executa o serviço
     *
     * @param GetPostageVoucherRequest $request
     * @return GetPostageVoucherResponse
     */
    public function __invoke(GetPostageVoucherRequest $request): GetPostageVoucherResponse
    {
        $response = new GetPostageVoucherResponse();

        $html = '';
        $html .= $this->generateHtml($request);

        $this->addHtml($html);
        $pdf = $this->generatePdf("voucher de postagem");

        $data = [];
        $data['pdf'] = $pdf;

        $response->setData($data);

        return $response->succeed();
    }

    /**
     * Retorna o html do voucher de postagem
     *
     * @param GetPostageVoucherRequest $data
     * @return string
     */
    private function generateHtml(GetPostageVoucherRequest $data): string
    {
        $prePostingListBarcode = $this->getBarcode(
            'prepostinglist',
            $data->getPrePostingList()->getId(),
            'C128',
            45,
            1.8
        );

        file_put_contents(
            self::STATIC_PATH . "/Image/{$data->getContract()}-barcode.png",
            $prePostingListBarcode->getData()['barcode']
        );

        $postageVoucher = $this->generateLabel(
            $data
        );

        return $postageVoucher;
    }

    /**
     * Gera os dados do voucher de postagem
     *
     * @param GetPostageVoucherRequest $data
     * @return string
     */
    private function generateLabel(
        GetPostageVoucherRequest $data
    ): string {
        $html = '';

        $html = file_get_contents(self::STATIC_PATH . '/Template/postageVoucher.tpl');

        $html = str_replace('{{correiosLogo}}', self::STATIC_PATH . '/Image/correios-logo.png', $html);
        $html = str_replace('{{barcode}}', self::STATIC_PATH . "/Image/{$data->getContract()}-barcode.png", $html);
        $html = str_replace("{{prePostingList}}", $data->getPrePostingList()->getId(), $html);
        $html = str_replace("{{contract}}", $data->getContract(), $html);
        $html = str_replace("{{senderName}}", $data->getSenderName(), $html);
        $html = str_replace("{{clientName}}", $data->getClientName(), $html);
        $html = str_replace("{{telephone}}", $data->getTelephone(), $html);
        $html = str_replace("{{email}}", $data->getEmail(), $html);

        $services = $data->getPostCardServices();
        $html = str_replace("{{services}}", $this->getServices($services), $html);

        return $html;
    }

    /**
     * Retorna os serviços do cartão de postagem
     *
     * @param array $services
     * @return string
     */
    private function getServices(array $services): string
    {
        $html = '';
        foreach ($services as $service) {
            $html .= '<tr>';
            $html .= '
                <td class="text-center">' .
                    $service->getPackagesQuantity() .
                '</td>';
            $html .= '
                <td class="text-center contract">' .
                $service->getserviceCode() . ' - ' . $service->getDescription() .
                '</td>';
            $html .= '</tr>';
        }

        return $html;
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
}
