<?php

namespace app\test;

use src\Model\CrawlerModel;

/**
 * CrawlerModelTest.
 * @coversNothing
 */
class CrawlerModelTest extends AbstractCrawlerTestCase
{
    /**
     * Instância da Model a ser testada.
     * @var CrawlerModel
     */
    protected $object;

    /**
     * Configurando a classe.
     */
    public function setUp(): void
    {
        parent::setUp();
        $this->object = new CrawlerModel();
    }

    public function testPreparaJson()
    {
        $this->object->prepararJson(self::$apoio->montaLinkPagina());
    }
}
