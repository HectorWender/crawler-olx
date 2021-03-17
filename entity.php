<?php
require "vendor/autoload.php";

use GuzzleHttp\Client;
use Symfony\Component\DomCrawler\Crawler;

class DomOLX
{
  function preparaAmbiente($filter, $url, $modelo = null)
  {
    $client = new Client();
    $resposta = $client->get($url);

    $html = $resposta->getBody()->getContents();
    $crawler = new Crawler($html);
    $contentContainer = $crawler->filter($filter);
    return $this->preparaJson($contentContainer, $modelo);
  }

  public function preparaJson($contentContainer, $modelo = null)
  {
    $response = [];
    $modeloFiltrado = [];

    foreach ($contentContainer as $index => $element) {
      foreach ($element->attributes as $attribute) {
        if ($attribute->nodeName == 'href' || $attribute->nodeName == 'title') {
          $response[$index]['attributes'][strtolower($attribute->nodeName)] =
            $this->strip_whitespace($attribute->nodeValue);

          if ($modelo) {
            if (stripos($response[$index]['attributes'][strtolower($attribute->nodeName)], $modelo) !== false)
              $modeloFiltrado[$index] = $response[$index];
          } else {
            $modeloFiltrado[$index] = $response[$index];
          }
        }
      }
    }
    file_put_contents('links.json', json_encode($modeloFiltrado, JSON_UNESCAPED_SLASHES));
    return $modeloFiltrado;
  }

  private static function strip_whitespace($data)
  {
    $data = preg_replace('/\s+/', ' ', $data);
    return trim($data);
  }
}
