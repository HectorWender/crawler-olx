<?php

namespace src\model;

/**
 * Responsável pela filtragem e preparação do json.
 */
class CrawlerModel
{
    /**
     * CrawlerModel constructor.
     */
    public function __construct()
    {
    }

    /**
     * Monta a estrutura do Json para apresentar.
     * @param mixed $contentContainer
     * @param mixed $marca
     * @param mixed $modelo
     * @return array
     */
    public function prepararJson($contentContainer)
    {
        $response = [];
        $modeloFiltrado = [];
        foreach ($contentContainer as $index => $element) {
            foreach ($element->attributes as $attribute) {
                if ('href' == $attribute->nodeName || 'title' == $attribute->nodeName) {
                    $response[$index]['attributes'][
            strtolower($attribute->nodeName)
          ] = $this->addSpace($attribute->nodeValue);
                    $modeloFiltrado[$index] = $response[$index];
                }
            }
        }

        return $modeloFiltrado;
    }

    /**
     * Adiciona um espaço em branco.
     * @param mixed $data
     * @return string
     */
    private static function addSpace($data)
    {
        $data = preg_replace('/\\s+/', ' ', $data);

        return trim($data);
    }
}
