<?php

/**
 * Este código faz parte do pacote do SIGEP das aplicações Live eCommerce.
 * (c) Live eCommerce <dev@liveecommerce.com.br>
 *
 * @version 1.0.0
 * @since 1.0.0 criação do pacote live-sigep
 */

namespace Live\Sigep\PostList\Application\Service;

use Live\Sigep\PrePostingList\Domain\Model\AdditionalServiceType;
use Live\Sigep\Sigep\Application\Service\AbstractGeneratePdf;

/**
 * Serviço de geração da lista de postagem
 *
 * @package Live\Sigep\PostList\Application\Service
 */
class GetPostListService extends AbstractGeneratePdf
{
    const STATIC_PATH = __DIR__ . '/../../Domain/Static/';

    /**
     * Executa o serviço
     *
     * @param GetPostListRequest $request
     * @return GetPostListResponse
     */
    public function __invoke(GetPostListRequest $request): GetPostListResponse
    {
        $response = new GetPostListResponse();

        $html = '';
        $html .= $this->generateHtml($request);

        $this->addHtml($html);
        $pdf = $this->generatePdf("lista de postagem");

        $data = [];
        $data['pdf'] = $pdf;

        $response->setData($data);

        return $response->succeed();
    }

    /**
     * Gera o html da lista de postagem
     *
     * @param GetPostListRequest $data
     * @return string
     */
    private function generateHtml(GetPostListRequest $data): string
    {
        $html = file_get_contents(self::STATIC_PATH . '/Template/postList.tpl');

        $html = str_replace('{{correiosLogo}}', self::STATIC_PATH . '/Image/correios-logo.png', $html);
        $html = str_replace("{{prePostingList}}", $data->getPrePostingList()->getId(), $html);
        $html = str_replace("{{contract}}", $data->getContract(), $html);
        $html = str_replace("{{administrativeCode}}", $data->getPrePostingList()->getId(), $html);
        $html = str_replace("{{postCardId}}", $data->getPostCardId(), $html);
        $html = str_replace("{{clientName}}", $data->getClientName(), $html);
        $html = str_replace("{{senderName}}", $data->getSenderName(), $html);
        $html = str_replace("{{telephone}}", $data->getTelephone(), $html);
        $html = str_replace("{{postDate}}", $data->getPostDate(), $html);

        $html = str_replace(
            "{{packagesQuantity}}",
            $this->getPackagesQuantity($data->getPostCardServices()),
            $html
        );

        $senderAddress = $data->getSenderAddress();
        $address = $senderAddress->getStreet();
        if ($senderAddress->getComplement()) {
            $address .= ' ' . $senderAddress->getComplement();
        }

        $address .= ', ' . $senderAddress->getNumber();
        $address .= ' - ' . $senderAddress->getDistrict();
        $html = str_replace("{{address}}", $address, $html);

        $address = $senderAddress->getCity() . '/' . $senderAddress->getState();
        $address .= ' - CEP: ' . $senderAddress->getZipCode();
        $html = str_replace("{{city}}", $address, $html);

        $postalObjects = $this->getObjectsList($data->getPostalObjects(), $data->getPostCardServices());
        $html = str_replace("{{postObjects}}", $postalObjects, $html);

        return $html;
    }

    /**
     * Retorna a quantidad de pacotes da lista de psotagem
     *
     * @param array $postCards
     * @return integer
     */
    private function getPackagesQuantity(array $postCards): int
    {
        $quantity = 0;
        foreach ($postCards as $cards) {
            $quantity += $cards->getPackagesQuantity();
        }

        return $quantity;
    }

    /**
     * Gera o html dos objetos de postagem
     *
     * @param array $postalObjects
     * @param array $services
     * @return string
     */
    private function getObjectsList(array $postalObjects, array $services): string
    {
        $html = '';
        foreach ($postalObjects as $objects) {
            $html .= '<tr class="post-objects">';
            $html .= '<td>';
            $html .= '<span class="label">' . $objects->getShippingLabel()->getLabel() . '</span></td>';
            $html .= '<td><span class="zipcode">' . $objects->getAddress()->getZipcode() . '</span></td>';
            $html .= '<td><span class="weight">' . $objects->getWeight() . '</span></td>';

            $service =  $objects->getAdditionalService();
            $ownHands = $this->translateAddicionalService(AdditionalServiceType::NATIONALOWNHAND, $service);
            $proofOfDelivery = $this->translateAddicionalService(AdditionalServiceType::PROOFOFDELIVERY, $service);
            $declaredValue = $objects->getDeclaredValue() ? 'Sim' : 'Não';

            $html .= '<td><span class="ar">' . $proofOfDelivery . '</span></td>';
            $html .= '<td><span class="additional">' . $ownHands . '</span></td>';
            $html .= '<td><span class="additional">' . $declaredValue . '</span></td>';

            $declaredValue =  $this->monetize($objects->getDeclaredValue());
            $html .= '<td><span class="declared-value">' . $declaredValue . '</span></td>';

            $html .= '<td><span class="invoice">' . $objects->getInvoiceNumber() . '</span></td>';
            $html .= '<td colspan="2"><span class="service-code">';

            $serviceCode = $objects->getServiceCode();
            $description = $services[$serviceCode]->getDescription();

            $html .= $serviceCode . ' - ' . $description;
            $html .= '</span></td>';
            $html .= '</tr>';

            $html .= '<tr class="receiver">';
            $html .= '<td colspan="9"><span class="bold">Destinatário: </span>' . $objects->getReceiverName();
            $html .= '</td></tr>';
        }

        return $html;
    }

    /**
     * Transforma o valor em reais
     *
     * @param string|null $value
     * @return string
     */
    private function monetize(?string $value): string
    {
        $value = "12365";

        if (!$value) {
            return "R$ 0,00";
        }

        $length = strlen($value);

        if($length == 1) {
            return "R$ 0,0" . $value;
        }

        if ($length == 2) {
            return "R$ 0," . $value;
        }

        $match = $length - 2;

        $decimals = substr($value, $match);
        $integer = substr($value, 0, -2);

        return "R$ " . $integer . ',' . $decimals;
    }

    /**
     * Traduz o serviço adicional caso ele seja igual ao valor esperado
     *
     * @param int $expected
     * @param int $addicionalService
     * @return string
     */
    private function translateAddicionalService(int $expected, int $addicionalService): string
    {
        if ($expected == $addicionalService) {
            return 'Sim';
        }

        return 'Não';
    }
}
