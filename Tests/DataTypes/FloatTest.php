<?php

namespace Tests\XPathArray\DataTypes;

use PHPUnit\Framework\TestCase;
use XPathArray\Exceptions\InvalidTypeException;
use XPathArray\Exceptions\XPathNotFoundException;
use XPathArray\XPathArray;

/**
 * Class FloatTest
 * @author Christian Dangl
 * @copyright 2018 by Christian Dangl
 * @package Tests\XPathArray\DataTypes
 */
class FloatTest extends TestCase
{

    /**
     * This test verifies that we correctly
     * find the existing xpath and its float value.
     * @test
     * @author Christian Dangl
     * @throws XPathNotFoundException
     * @throws \XPathArray\Exceptions\InvalidTypeException
     */
    public function getFloat_valid_type()
    {
        $data = array(
            'amount' => 39.99,
        );

        $xPathArray = new XPathArray('/', $data);

        /** @var int $value */
        $value = $xPathArray->getFloat('amount');

        $this->assertInternalType("float", $value);
        $this->assertEquals(39.99, $value);
    }

    /**
     * This test verifies that we get a correct
     * exception if the found node is of type STRING.
     * @test
     * @author Christian Dangl
     * @throws XPathNotFoundException
     * @throws \XPathArray\Exceptions\InvalidTypeException
     */
    public function getFloat_invalid_type_string()
    {
        $data = array(
            'amount' => "test",
        );

        $xPathArray = new XPathArray('/', $data);

        $this->expectException(InvalidTypeException::class);
        $this->expectExceptionMessage('Value for XPath amount is no Float');

        $xPathArray->getFloat('amount');
    }

    /**
     * This test verifies that we get a correct
     * exception if the value is of type BOOL.
     * @test
     * @author Christian Dangl
     * @throws XPathNotFoundException
     * @throws \XPathArray\Exceptions\InvalidTypeException
     */
    public function getFloat_invalid_type_bool()
    {
        $data = array(
            'amount' => false,
        );

        $xPathArray = new XPathArray('/', $data);

        $this->expectException(InvalidTypeException::class);
        $this->expectExceptionMessage('Value for XPath /amount is no Float');

        $xPathArray->getFloat('/amount');
    }

    /**
     * This test verifies that we get the found float
     * value, even if we have provided a default value.
     * @test
     * @author Christian Dangl
     * @throws InvalidTypeException
     * @throws XPathNotFoundException
     */
    public function getFloat_with_default_valueFound()
    {
        $data = array(
            'amount' => 39.99,
        );

        $xPathArray = new XPathArray('/', $data);

        $value = $xPathArray->getFloat('/amount', 0);

        $this->assertEquals(39.99, $value);
    }

    /**
     * This test verifies that we get the correct default value
     * if we did not find the xpath value.
     * @test
     * @author Christian Dangl
     * @throws InvalidTypeException
     * @throws XPathNotFoundException
     */
    public function getFloat_with_default_valueNotFound()
    {
        $data = array(
            'amount' => 39.99,
        );

        $xPathArray = new XPathArray('/', $data);

        $value = $xPathArray->getFloat('/unknown', 0.0);

        $this->assertEquals(0.0, $value);
    }

    /**
     * This test verifies that we get the default value
     * if the original xpath value is NULL.
     * @test
     * @author Christian Dangl
     * @throws InvalidTypeException
     * @throws XPathNotFoundException
     */
    public function getFloat_with_default_valueNull()
    {
        $data = array(
            'amount' => null
        );

        $xPathArray = new XPathArray('/', $data);

        $value = $xPathArray->getFloat('/amount', 0.0);

        $this->assertEquals(0.0, $value);
    }

}
