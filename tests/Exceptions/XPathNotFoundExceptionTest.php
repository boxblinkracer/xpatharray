<?php

namespace Tests\XPathArray\Exceptions;

use PHPUnit\Framework\TestCase;
use XPathArray\Exceptions\XPathNotFoundException;

/**
 * Class XPathNotFoundExceptionTest
 * @author Christian Dangl
 * @copyright 2018 by Christian Dangl
 * @package Tests\XPathArray\Exceptions
 */
class XPathNotFoundExceptionTest extends TestCase
{

    /**
     * This test verifies that we get the expected
     * message for our exception. It should always
     * output our provided XPath in the message.
     * @test
     * @author: Christian Dangl
     */
    public function getMessage()
    {
        $e = new XPathNotFoundException('/name');

        $this->assertEquals('XPath not found: /name', $e->getMessage());
    }

}
