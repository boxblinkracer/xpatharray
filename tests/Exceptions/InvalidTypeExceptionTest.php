<?php

namespace Tests\XPathArray\Exceptions;

use PHPUnit\Framework\TestCase;
use XPathArray\Exceptions\InvalidTypeException;
use XPathArray\Exceptions\XPathNotFoundException;

/**
 * Class InvalidTypeExceptionTest
 * @author Christian Dangl
 * @copyright dasistweb GmbH (http://www.dasistweb.de)
 * @package Tests\XPathArray\Exceptions
 */
class InvalidTypeExceptionTest extends TestCase
{

    /**
     * @test
     * @author Christian Dangl
     */
    public function getMessage()
    {
        $e = new InvalidTypeException('my message');

        $this->assertEquals('my message', $e->getMessage());
    }

}
