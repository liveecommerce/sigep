<?php

/**
 * Este código faz parte do pacote do SIGEP das aplicações Live eCommerce.
 * (c) Live eCommerce <dev@liveecommerce.com.br>
 *
 * @version 1.0.0
 * @since 1.0.0 criação do pacote live-sigep
 */

namespace Live\Sigep\AddressingLabel\Application\Service;

use Live\Sigep\Barcode\Application\Service\GenerateBarcodeRequest;
use Live\Sigep\Barcode\Application\Service\GenerateBarcodeService;
use Live\Sigep\Address\Application\Service\VerifyingZipCodeService;
use Live\Sigep\Barcode\Application\Service\GenerateBarcodeResponse;
use Live\Sigep\Sigep\Application\Service\AbstractGeneratePdf;


/**
 * Serviço de criação de rótulo de endereçamento dos Correios
 *
 * @package Live\Sigep\AddressingLabel\Application\Service
 */
class GetAddressingLabelService extends AbstractGeneratePdf
{
    const STATIC_PATH = __DIR__ . '/../../Domain/Static';

    /**
     * Constante com os espaços reservados no datamatrix
     */
    const RESERVED_DATA = '000000000000-00.000000-00.000000';

    /**
     * Constante com o valor padrão do serviço adicional
     */
    const ADDITIONAL_SERVICE = '250000000000';

    /**
     * Constante de tipo de entrega do Sedex
     */
    const SEDEX = 1;

    /**
     * Constante de tipo de entrega do PAC
     */
    const PAC = 2;

    /**
     * Constante de tipo de entrega do sedex hoje
     */
    const SEDEX_HOJE = 3;

    /**
     * Constante de tipo de entrega do sedex 10
     */
    const SEDEX_10 = 4;

    /**
     * Constante de tipo de entrega do sedex 12
     */
    const SEDEX_12 = 5;

     /**
     * @param array $request
     * @return GetAddressingLabelResponse
     */
    /**
     * Executa o serviço
     *
     * @param array $request
     * @return GetAddressingLabelResponse
     */
    public function __invoke(array $request): GetAddressingLabelResponse
    {
        $response = new GetAddressingLabelResponse();

        $this->clearAllImages(current($request)->getContract());

        $html = '<table style="border-collapse:collapse">';
        $labelLine = 0;
        foreach ($request as $data) {
            if ($labelLine > 1) {
                $labelLine = 0;
                $html .= "</tr>";
            }

            if ($labelLine == 0) {
                $html .= "<tr>";
            }

            $html .= $this->generateHtmlLabel($data);

            $labelLine++;
        }

        if ($labelLine != 0) {
            $html .= "</tr>";
        }

        $html .= "</table>";

        $this->addHtml($html);
        $this->generatePdf("rotulos de enderecamento");

        return $response->succeed();
    }

    /**
     * Exclui todas as imagens antigas das etiquetas
     *
     * @param string $data
     * @return void
     */
    private function clearAllImages(string $data): void
    {
        $dataMatrix = glob(self::STATIC_PATH . "/Image/datamatrix-{$data}*.png");
        $shipping = glob(self::STATIC_PATH . "/Image/shipping-{$data}*.png");
        $zipcode = glob(self::STATIC_PATH . "/Image/zipcode-{$data}*.png");
        
        $images = array_merge($dataMatrix, $shipping, $zipcode);

        array_map(function($link) {
            return unlink($link);
        }, $images);
    }

    /**
     * Retorna o html do rótulo de endereçamento
     *
     * @param GetAddressingLabelRequest $data
     * @return string
     */
    private function generateHtmlLabel(GetAddressingLabelRequest $data): string
    {
        $label = $data->getShippingLabel()->getLabel();

        $shippingLabelBarcode = $this->getBarcode(
            'shipping',
            $label,
            'C128',
            60,
            1.9
        );

        $shippingUrl = self::STATIC_PATH . "/Image/shipping-{$data->getContract()}-{$label}.png";
        file_put_contents($shippingUrl, $shippingLabelBarcode->getData()['barcode']);

        $zipcodeUrl = self::STATIC_PATH . "/Image/zipcode-{$data->getContract()}-{$label}.png";
        $zipcodeBarcode = $this->getBarcode('zipcode', $data->getReceiverAddress()->getZipCode(), 'C128', 60, 2);
        file_put_contents($zipcodeUrl, $zipcodeBarcode->getData()['barcode']);

        $dataMatrixUrl = self::STATIC_PATH . "/Image/datamatrix-{$data->getContract()}-{$label}.png";
        $dataMatrix = $this->getDataMatrix('datamatrix', $data, 2.5, 2.5);
        file_put_contents($dataMatrixUrl, $dataMatrix->getData()['barcode']);

        $addressesLabel = $this->generateLabel(
            $data
        );

        return $addressesLabel;
    }

    /**
     * Gera os dados do rótulo de endereçamento dos Correios
     *
     * @param GetAddressingLabelRequest $data
     * @return string
     */
    private function generateLabel(
        GetAddressingLabelRequest $data
    ): string {
        if ($data->getFormat() == 1) {
            $html = file_get_contents(self::STATIC_PATH . '/Template/smallAddressesLabel.tpl');
        } else {
            $html = file_get_contents(self::STATIC_PATH . '/Template/largeAddressesLabel.tpl');

            $path = self::STATIC_PATH . '/Image/storeLogo.png';
            file_put_contents($path, file_get_contents($data->getLogoUrl()));

            $html = str_replace("{{storeLogo}}", $path, $html);
        }

        $label = $data->getShippingLabel()->getLabel();

        $html = str_replace('{{correiosLogo}}', self::STATIC_PATH . '/Image/correios-logo.png', $html);

        $shippingType = $this->getShippingTypeString($data->getShippingType());
        $html = str_replace("{{shippingType}}", $shippingType[0], $html);
        $html = str_replace("{{shippingLogo}}", $shippingType[1], $html);

        $shippingUrl = self::STATIC_PATH . "/Image/shipping-{$data->getContract()}-{$label}.png";
        $zipcodeUrl = self::STATIC_PATH . "/Image/zipcode-{$data->getContract()}-{$label}.png";
        $dataMatrixUrl = self::STATIC_PATH . "/Image/datamatrix-{$data->getContract()}-{$label}.png";

        $html = str_replace("{{datamatrix}}", $dataMatrixUrl, $html);
        $html = str_replace("{{barcodeShipping}}", $shippingUrl, $html);
        $html = str_replace("{{zipcodeBarcode}}", $zipcodeUrl, $html);
        $html = str_replace("{{invoice}}", $data->getInvoice(), $html);
        $html = str_replace("{{orderId}}", $data->getOrderId(), $html);
        $html = str_replace("{{contract}}", $data->getContract(), $html);
        $html = str_replace("{{weight}}", $data->getWeight(), $html);

        $receiver = $data->getReceiverAddress();
        $html = str_replace("{{receiverName}}", $data->getReceiverName(), $html);
        $html = str_replace("{{receiverStreet}}", $receiver->getStreet(), $html);
        $html = str_replace("{{receiverNumber}}", $receiver->getNumber(), $html);
        $html = str_replace("{{receiverComplement}}", $receiver->getComplement(), $html);
        $html = str_replace("{{receiverState}}", $receiver->getState(), $html);
        $html = str_replace("{{receiverDistrict}}", $receiver->getDistrict(), $html);
        $html = str_replace("{{receiverZipCode}}", $receiver->getZipCode(), $html);
        $html = str_replace("{{receiverCity}}", $receiver->getCity(), $html);

        $sender = $data->getSenderAddress();
        $html = str_replace("{{senderName}}", $data->getSenderName(), $html);
        $html = str_replace("{{senderStreet}}", $sender->getStreet(), $html);
        $html = str_replace("{{senderNumber}}", $sender->getNumber(), $html);
        $html = str_replace("{{senderComplement}}", $sender->getComplement(), $html);
        $html = str_replace("{{senderState}}", $sender->getState(), $html);
        $html = str_replace("{{senderDistrict}}", $sender->getDistrict(), $html);
        $html = str_replace("{{senderZipCode}}", $sender->getZipCode(), $html);
        $html = str_replace("{{senderCity}}", $sender->getCity(), $html);

        $shippingLabel = $this->getShippingLabelWithSpaces($label);
        $html = str_replace("{{shippingLabel}}", $shippingLabel, $html);

        $addicionalServices = $this->getAdditionalServicesHtml($data->getAdditionalServices());
        $html = str_replace("{{addicionalService}}", $addicionalServices, $html);

        return $html;
    }

    /**
     * Retorna a etiquetas com espaço entre o texto
     *
     * @param string $shippingLabel
     * @return string
     */
    private function getShippingLabelWithSpaces(string $shippingLabel): string
    {
        $shipping = '';

        $shipping .= substr($shippingLabel, 0, 2) . ' ';
        $shipping .= substr($shippingLabel, 2, 3) . ' ';
        $shipping .= substr($shippingLabel, 5, 3) . ' ';
        $shipping .= substr($shippingLabel, 8, 3) . ' ';
        $shipping .= substr($shippingLabel, 11, 2);

        return $shipping;
    }

    /**
     * Retorna o tipo de entrega em formato de texto com sua respectiva imagem
     *
     * @param int $shippingType Tipo de serviço de entrega
     * @return array
     */
    private function getShippingTypeString(int $shippingType): array
    {
        switch ($shippingType)
        {
            case self::SEDEX:
                return ['SEDEX', self::STATIC_PATH . '/Image/sedex.png'];
                break;
            case self::PAC:
                return ['PAC', self::STATIC_PATH . '/Image/pac.png'];
                break;
            case self::SEDEX_HOJE:
                return ['SEDEX Hoje', self::STATIC_PATH . '/Image/sedex-hoje.png'];
                break;
            case self::SEDEX_10:
                return ['SEDEX 10', self::STATIC_PATH . '/Image/sedex-hoje.png'];
                break;
            case self::SEDEX_12:
                return ['SEDEX 12', self::STATIC_PATH . '/Image/sedex-hoje.png'];
                break;
        }
    }

    /**
     * Gera o html dos serviços adicionais
     *
     * @param array $addicionalServices
     * @return string
     */
    private function getAdditionalServicesHtml(array $addicionalServices): string
    {
        if (!$addicionalServices) {
            return '';
        }

        $servicesTable = '';
        $labelLine = 0;
        foreach ($addicionalServices as $service) {
            if ($labelLine > 1) {
                $labelLine = 0;
                $servicesTable .= "</tr>";
            }

            if ($labelLine == 0) {
                $servicesTable .= "<tr>";
            }

            $servicesTable .= "<td>" . $service . "</td>";

            $labelLine++;
        }

        if ($labelLine != 0) {
            $servicesTable .= "</tr>";
        }

        return $servicesTable;
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
     * Preenche as strings com um dado especifico
     *
     * @param string|null $label
     * @param int $minLength
     * @param string $data
     * @param boolean|null $right
     * @return string
     */
    private function fillWithData(
        ?string $label,
        int $minLength,
        string $data,
        ?bool $right = false
    ): string {
        if (strlen($label) >= $minLength) {
            return $label;
        }

        $position = STR_PAD_RIGHT;
        if (!$right) {
            $position = STR_PAD_LEFT;
        }

        $label = str_pad($label, $minLength, $data, $position);

        return $label;
    }

    /**
     * Retorna apenas os números de uma string
     * 
     * @param $string label
     * @return string
     */
    private function removeAllNonNumbers(string $label): string
    {
        $label = preg_replace('/[^\d]/', '', $label);
        return $label;
    }

    /**
     * Retorna o datamatrix
     *
     * @param string $name
     * @param GetAddressingLabelRequest $data
     * @param float $height
     * @param float $width
     * @return GenerateBarcodeResponse
     */
    private function getDataMatrix(
        string $name,
        GetAddressingLabelRequest $data,
        float $height,
        float $width
    ): GenerateBarcodeResponse {
        $code = '';

        $receiverAddress = $data->getReceiverAddress();
        $senderAddress = $data->getSenderAddress();

        $receiverComplement = $receiverAddress->getComplement();
        $senderComplement = $senderAddress->getComplement();

        $service = new VerifyingZipCodeService;
        $verifyingZipCodeResponse = $service($receiverAddress);
        $verifyingZipCode = $verifyingZipCodeResponse->getData()['verifyingZipCode'];

        $addicionalService = self::ADDITIONAL_SERVICE;
        if ($data->getAdditionalServices()) {
            $addicionalService = '';

            foreach ($data->getAdditionalServices() as $service) {
                $addicionalService .= $service;
            }

            $addicionalService = $this->fillWithData($addicionalService, 12, '0');
        }

        $code = '';
        $code .= $receiverAddress->getZipCode();
        $code .= $this->fillWithData($this->removeAllNonNumbers($receiverAddress->getNumber()), 5, '0');
        $code .= $senderAddress->getZipCode();
        $code .= $this->fillWithData($this->removeAllNonNumbers($senderAddress->getNumber()), 5, '0');
        $code .= $verifyingZipCode;
        $code .= $data->getVariableDataIdentifier();
        $code .= $data->getShippingLabel()->getLabel();
        $code .= $addicionalService;
        $code .= $data->getPostCard();
        $code .= $data->getServiceCode();
        $code .= $this->fillWithData($data->getGroupingInformation(), 2, '0');
        $code .= $this->fillWithData($receiverAddress->getNumber(), 5, '0');
        $code .= $this->fillWithData($receiverComplement, 20, ' ', true);
        $code .= $this->fillWithData($data->getDeclaredValue(), 5, '0');
        $code .= self::RESERVED_DATA . '|';
        $code .= $this->fillWithData(null, 30, '0');

        $request = new GenerateBarcodeRequest($name, $code, GenerateBarcodeService::DATAMATRIX, $height, $width);

        $service = new GenerateBarcodeService();
        $response = $service($request);

        return $response;
    }
}
