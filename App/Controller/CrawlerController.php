<?php

namespace App\Controller;

use GuzzleHttp\Client;
use Symfony\Component\DomCrawler\Crawler;
use App\Model\CrawlerModel;

/**
 * Responsável pelas requisições da tela.
 * @package App\Controller
 */
class CrawlerController
{
    /**
     * CrawlerController constructor
     */
    public function __construct()
    {
        $this->cModel = new CrawlerModel();
        $this->client = new Client();
        set_time_limit(0);
    }

    /**
     * Monta os links de todas as páginas de acordo com a última página
     * @param string $filter
     * @param string $url
     * @param string $marca
     * @param string $modelo
     * @return array
     */
    public function percorrerPagina($filter, $url, $marca = null, $modelo = null)
    {
        $i = 2;
        // $result = ['Não existem carros disponíveis nessa marca ou modelo!'];
        $result = [];
        $link = $url .'/'. strtolower($marca) .'/'. strtolower($modelo);

        $lastPag = $this->pegarUltimaPag($link);

        //Separa os números da string
        $numLastPg = preg_replace("/[^0-9]/","", $lastPag);

        $result = $this->prepararAmbiente($filter, $link, $marca, $modelo);

        //Verifica se existe mais de uma página
        if ($numLastPg) {
          while($i <= $numLastPg){
              $result = $this->prepararAmbiente($filter, $link.'?o='
              .$i, $marca, $modelo);
              $i++;
          }
        }

        return $result;
    }

    /**
     * Filtra os campos da tela
     * @param string $filter
     * @param string $url
     * @param string $marca
     * @param string $modelo
     * @return array
     */
    public function prepararAmbiente($filter, $url, $marca = null, $modelo = null)
    {
        $resposta = $this->client->get($url);

        $html = $resposta->getBody()->getContents();
        $crawler = new Crawler($html);

        $contentContainer = $crawler->filter($filter);

        return $this->cModel->prepararJson($contentContainer, $marca, $modelo);
    }

    /**
     * Retorna a última página
     * @param string $url
     * @return Crawler
     */
    public function pegarUltimaPag($url)
    {
        $resposta = $this->client->get($url);

        $html = $resposta->getBody()->getContents();
        $crawler = new Crawler($html);

        return $crawler->filter('a[data-lurker-detail="last_page"]')->attr('href');
    }
}