<?php

/**
 * Este código faz parte do pacote do SIGEP das aplicações Live eCommerce.
 * (c) Live eCommerce <dev@liveecommerce.com.br>
 *
 * @version 1.0.0
 * @since 1.0.0 criação do pacote live-sigep
 */

namespace Live\Sigep\Sigep\Application\Service;

use \DOMDocument;
use \DOMElement;
use Exception;

/**
 * Geração abstrata de Xml
 *
 * @package Live\Sigep\Sigep\Application\Service
 */
abstract class AbstractGenerateXml
{
    /**
     * Objeto de xml
     *
     * @var DOMDocument
     */
    protected $domDocument;

    /**
     * Elemento base do xml
     *
     * @var DOMElement
     */
    protected $baseElement;

    /**
     * Cria o DomDocument
     *
     * @param string $encoding
     * @return self
     */
    protected function createDomDocument(
        string $encoding = 'ISO-8859-1'
    ): self {
        libxml_use_internal_errors(true);

        $this->domDocument = new DOMDocument("1.0", $encoding);
        return $this;
    }

    /**
     * Cria o xml
     *
     * @param array $data
     * @param string $baseTag
     * @param string $encoding
     * @param array $attribute
     * @return self
     */
    protected function createXmlDocument(
        string $baseTag,
        string $encoding = 'ISO-8859-1',
        array $attributes = null
    ): self {
        $this->createDomDocument($encoding);

        $this->baseElement = $this->domDocument->createElement($baseTag);

        if ($attributes) {
            foreach ($attributes as $index => $attribute) {
                $domAttribute = $this->domDocument->createAttribute($index);
                $domAttribute->value = $attribute;
                $this->baseElement->appendChild($domAttribute);
            }
        }

        return $this;
    }

    /**
     * Adiciona um ou vários elementos
     *
     * @param array $data
     * @return self
     */
    protected function addElement(array $data): self
    {
        foreach ($data as $index => $value) {
            $node = $this->addChild($this->baseElement, $index, $value);

            $this->baseElement->appendChild($node);
        }

        $this->domDocument->appendChild($this->baseElement);

        return $this;
    }

    /**
     * Adiciona um novo node no xml
     *
     * @param mixed $baseElement
     * @param mixed $dataIndex
     * @param mixed $dataValue
     * @return DOMElement
     */
    private function addChild($baseElement, $dataIndex, $dataValue): DOMElement
    {
        if (!is_array($dataValue)) {
            $nodeElement = $this->domDocument->createElement($dataIndex, $dataValue);
        } elseif ($dataValue['value'] !== null) {
            if (!array_key_exists('C_DATA', $dataValue) ||
                !array_key_exists('value', $dataValue)
            ) {
                $nodeElement = $this->domDocument->createElement($dataIndex, $dataValue['value']);
            } else {
                $nodeElement = $this->domDocument->createElement($dataIndex);
                $cDataElement = $this->domDocument->createCDATASection($dataValue['value']);
                $nodeElement->appendChild($cDataElement);
            }
        } else {
            $nodeElement = $this->domDocument->createElement($dataIndex);

            foreach ($dataValue as $index => $value) {
                if (!is_numeric($index)) {
                    $childElement = $this->addChild($nodeElement, $index, $value);
                    $nodeElement->appendChild($childElement);
                } else {
                    foreach ($value as $nodeIndex => $data) {
                        $nodeData = $this->domDocument->createElement($nodeIndex);

                        $childElement = $this->addChild($nodeData, $nodeIndex, $data);
                        $nodeElement->appendChild($childElement);
                    }
                }
            }
        }

        return $baseElement->appendChild($nodeElement);
    }

    /**
     * Retorna o valor do xml
     *
     * @return string
     */
    public function getXml(): string
    {
        return $this->domDocument->saveXml();
    }

     /**
     * Retorna o valor do html
     *
     * @return string
     */
    public function getHtml(): string
    {
        return $this->domDocument->saveHtml();
    }

    /**
     * Valida os erros do xml utilizando arquivo xsd
     *
     * @return array
     */
    public function validateXml(string $xsd): array
    {
        if (!$xsd) {
            return [];
        }

        $errorData = [];

        if ($this->domDocument->schemaValidate($xsd)) {
            return [];
        }

        $errors = libxml_get_errors();
        foreach ($errors as $error) {
            $errorData[] = [
                'code' => $error->code,
                'message' => $error->message,
                'file' => $error->file,
                'line' => $error->line
            ];
        }

        libxml_clear_errors();

        return $errorData;
    }
}
