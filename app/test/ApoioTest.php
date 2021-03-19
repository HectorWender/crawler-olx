<?php

namespace app\test;

use src\controller\CrawlerController;

/**
 * ApoioTest.
 * @coversNothing
 */
class ApoioTest extends AbstractCrawlerTestCase
{
    /**
     * Método de apoio á model.
     */
    public function montaLinkPagina()
    {
        $object = new CrawlerController();

        $filter = 'a[data-lurker-detail="list_id"]';
        $url = 'https://www.olx.com.br/autos-e-pecas/carros-vans-e-utilitarios';
        $marca = 'fiat';
        $modelo = 'uno';

        return $object->percorrerPagina($filter, $url, $marca, $modelo);
    }
}
