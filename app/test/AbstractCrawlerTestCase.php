<?php

namespace app\test;

use PHPUnit\Framework\TestCase;

/**
 * AbstractCrawlerTestCase.
 */
abstract class AbstractCrawlerTestCase extends TestCase
{
    /**
     * Instancia da Classe de apoio.
     * @var ApoioTest
     */
    protected static $apoio = null;

    /**
     * Configurando a Classe.
     */
    public static function setUpBeforeClass(): void
    {
        parent::setUpBeforeClass();
        if (is_null(self::$apoio)) {
            self::$apoio = new ApoioTest();
        }
    }
}
