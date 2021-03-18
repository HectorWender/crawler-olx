<?php

namespace App\Model;

class CrawlerModel
{        
    /**
     * CrawlerModel constructor
     * @return void
     */
    public function __construct() { }
    
    /**
     * Monta a estrutura do Json para apresentar
     * @param  mixed $contentContainer
     * @param  mixed $marca
     * @param  mixed $modelo
     * @return array
     */
    public function prepararJson($contentContainer, $marca = null, $modelo = null)
    {
        $response = [];
        $modeloFiltrado = [];
        foreach ($contentContainer as $index => $element) {
            foreach ($element->attributes as $attribute) {
              if ($attribute->nodeName == 'href' || $attribute->nodeName == 'title') {
                  $response[$index]['attributes'][strtolower($attribute->nodeName)] =
                    $this->espacoBranco($attribute->nodeValue);
                      $modeloFiltrado[$index] = $response[$index];
              }
            }
        }

        return $modeloFiltrado;
    }
    
    /**
     * Adiciona um espaço em branco
     * @param  mixed $data
     * @return string
     */
    private static function espacoBranco($data)
    {
        $data = preg_replace('/\s+/', ' ', $data);
        return trim($data);
    }
    
}