<?php

namespace Tests\XPathArray\Exceptions;

use PHPUnit\Framework\TestCase;
use XPathArray\Exceptions\InvalidTypeException;
use XPathArray\Exceptions\XPathNotFoundException;

/**
 * Class InvalidTypeExceptionTest
 * @author Christian Dangl
 * @copyright 2018 by Christian Dangl
 * @package Tests\XPathArray\Exceptions
 */
class InvalidTypeExceptionTest extends TestCase
{

    /**
     * This test verfies that our provided
     * message is really reeturned in our getMessage function.
     * @test
     * @author: Christian Dangl
     */
    public function getMessage()
    {
        $e = new InvalidTypeException('my message');

        $this->assertEquals('my message', $e->getMessage());
    }

}
