<?php

namespace Acquia\Search\API\Test;

use Acquia\Search\API\SearchServiceClient;

class DummyTest extends \PHPUnit_Framework_TestCase
{
    /**
     * A dummy test that calls a beacon method ensuring the class is autolaoded.
     *
     * @see https://github.com/cpliakas/php-project-starter/issues/19
     * @see https://github.com/cpliakas/php-project-starter/issues/21
     */
    public function testAutoload()
    {
        $class = new SearchServiceClient();
        $this->assertTrue($class->autoloaded());
    }
}
