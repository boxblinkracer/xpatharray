<?php

namespace Tests\XPathArray\Exceptions;

use PHPUnit\Framework\TestCase;
use XPathArray\Exceptions\XPathNotFoundException;

/**
 * Class XPathNotFoundExceptionTest
 * @author Christian Dangl
 * @copyright dasistweb GmbH (http://www.dasistweb.de)
 * @package Tests\XPathArray\Exceptions
 */
class XPathNotFoundExceptionTest extends TestCase
{

    /**
     * @test
     * @author Christian Dangl
     */
    public function getMessage()
    {
        $e = new XPathNotFoundException('/name');

        $this->assertEquals('XPath not found: /name', $e->getMessage());
    }

}
