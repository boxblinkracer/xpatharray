<?php

namespace Tests\XPathArray\DataTypes;

use PHPUnit\Framework\TestCase;
use XPathArray\Exceptions\InvalidTypeException;
use XPathArray\Exceptions\XPathNotFoundException;
use XPathArray\XPathArray;

/**
 * Class StringTest
 * @author Christian Dangl
 * @copyright 2018 by Christian Dangl
 * @package Tests\XPathArray\DataTypes
 */
class StringTest extends TestCase
{

    /**
     * This test verifies that we get the correct
     * string if our xpath has been found and
     * its value is of type STRING.
     * @test
     * @author: Christian Dangl
     * @throws InvalidTypeException
     * @throws XPathNotFoundException
     */
    public function getString_valid_type()
    {
        $data = array(
            'name' => 'max',
        );

        $xPathArray = new XPathArray('/', $data);

        /** @var string $value */
        $value = $xPathArray->getString('name');

        $this->assertInternalType("string", $value);
        $this->assertEquals("max", $value);
    }

    /**
     * This test verifies that we get the correct
     * exception if our xpath value is of type INT and no STRING.
     * @test
     * @author Christian Dangl
     * @throws XPathNotFoundException
     * @throws \XPathArray\Exceptions\InvalidTypeException
     */
    public function getString_invalid_type_int()
    {
        $data = array(
            'name' => 12,
        );

        $xPathArray = new XPathArray('/', $data);

        $this->expectException(InvalidTypeException::class);
        $this->expectExceptionMessage('Value for XPath name is no String');

        $xPathArray->getString('name');
    }

    /**
     * This test verifies that we get the correct
     * exception if our xpath value is of type BOOL and no STRING.
     * @test
     * @author Christian Dangl
     * @throws XPathNotFoundException
     * @throws \XPathArray\Exceptions\InvalidTypeException
     */
    public function getString_invalid_type_bool()
    {
        $data = array(
            'name' => false,
        );

        $xPathArray = new XPathArray('/', $data);

        $this->expectException(InvalidTypeException::class);
        $this->expectExceptionMessage('Value for XPath name is no String');

        $xPathArray->getString('name');
    }

    /**
     * This test verifies that we get the correct value
     * if found, even though we have provided a default value.
     * @test
     * @author Christian Dangl
     * @throws InvalidTypeException
     * @throws XPathNotFoundException
     */
    public function getString_with_default_valueFound()
    {
        $data = array(
            'name' => 'max',
        );

        $xPathArray = new XPathArray('/', $data);

        $value = $xPathArray->getString('/name', '-');

        $this->assertInternalType("string", $value);
        $this->assertEquals('max', $value);
    }

    /**
     * This test verifies that we get the correct default value
     * if the original xpath value has not been found.
     * @test
     * @author Christian Dangl
     * @throws InvalidTypeException
     * @throws XPathNotFoundException
     */
    public function getString_with_default_valueNotFound()
    {
        $data = array(
            'name' => 'max'
        );

        $xPathArray = new XPathArray('/', $data);

        $value = $xPathArray->getString('/unknown', '-');

        $this->assertEquals('-', $value);
    }

    /**
     * This test verifies that we get the provided default value
     * if our original xpath value is NULL.
     * @test
     * @author Christian Dangl
     * @throws InvalidTypeException
     * @throws XPathNotFoundException
     */
    public function getString_with_default_valueNull()
    {
        $data = array(
            'name' => null,
        );

        $xPathArray = new XPathArray('/', $data);

        $value = $xPathArray->getString('/name', '-');

        $this->assertEquals('-', $value);
    }

}
