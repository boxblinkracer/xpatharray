<?php

namespace Tests\XPathArray\DataTypes;

use PHPUnit\Framework\TestCase;
use XPathArray\Exceptions\InvalidTypeException;
use XPathArray\Exceptions\XPathNotFoundException;
use XPathArray\XPathArray;

/**
 * Class BoolTest
 * @author Christian Dangl
 * @copyright 2018 by Christian Dangl
 * @package Tests\XPathArray\DataTypes
 */
class BoolTest extends TestCase
{

    /**
     * This test verifies that we get our
     * bool TRUE when we access it with xpath.
     * @test
     * @author Christian Dangl
     * @throws XPathNotFoundException
     * @throws \XPathArray\Exceptions\InvalidTypeException
     */
    public function getBool_valid_type()
    {
        $data = array(
            'success' => true,
        );

        $xPathArray = new XPathArray('/', $data);

        /** @var string $value */
        $value = $xPathArray->getBool('success');

        $this->assertInternalType("bool", $value);
    }

    /**
     * This test verifies that we get a correct
     * exception when we try to access a BOOL xpath,
     * that has no boolean value (string in this case).
     * @test
     * @author Christian Dangl
     * @throws XPathNotFoundException
     * @throws \XPathArray\Exceptions\InvalidTypeException
     */
    public function getBool_invalid_type_string()
    {
        $data = array(
            'success' => 'max',
        );

        $xPathArray = new XPathArray('/', $data);

        $this->expectException(InvalidTypeException::class);
        $this->expectExceptionMessage('Value for XPath success is no Bool');

        $xPathArray->getBool('success');
    }

    /**
     * This test verifies that our getBool function
     * does handle INT values (1 / 0) as boolean entries.
     * @test
     * @dataProvider getBoolFromIntData
     * @author: Christian Dangl
     * @param bool $expected
     * @param int $value
     * @throws InvalidTypeException
     * @throws XPathNotFoundException
     */
    public function getBool_fromInt(bool $expected, int $value)
    {
        $data = array(
            'success' => $value,
        );

        $xPathArray = new XPathArray('/', $data);

        /** @var bool $value */
        $value = $xPathArray->getBool('success');

        $this->assertInternalType("bool", $value);
        $this->assertEquals($expected, $value);
    }

    /**
     * @author: Christian Dangl
     * @return array
     */
    public function getBoolFromIntData(): array
    {
        return array(
            'true' => array(true, 1),
            'TRUE' => array(false, 0),
        );
    }

    /**
     * This test verifies that our getBool function
     * does handle STRING values (true/TRUE/false/FALSE)
     * as boolean entries.
     * @test
     * @dataProvider getBoolFromStringData
     * @author: Christian Dangl
     * @param bool $expected
     * @param string $value
     * @throws InvalidTypeException
     * @throws XPathNotFoundException
     */
    public function getBool_fromString(bool $expected, string $value)
    {
        $data = array(
            'success' => $value,
        );

        $xPathArray = new XPathArray('/', $data);

        /** @var bool $value */
        $value = $xPathArray->getBool('success');

        $this->assertInternalType("bool", $value);
        $this->assertEquals($expected, $value);
    }

    /**
     * @author: Christian Dangl
     * @return array
     */
    public function getBoolFromStringData(): array
    {
        return array(
            'true' => array(true, "true"),
            'TRUE' => array(true, "TRUE"),
            'false' => array(false, "false"),
            'FALSE' => array(false, "FALSE"),
            '1' => array(true, "1"),
            '0' => array(false, "0"),
        );
    }

    /**
     * This test verifies that all other INT
     * values than 1/0 lead to an exception,
     * that the found value is no BOOL.
     * @test
     * @author Christian Dangl
     * @throws XPathNotFoundException
     * @throws \XPathArray\Exceptions\InvalidTypeException
     */
    public function getBool_invalid_type_int()
    {
        $data = array(
            'success' => 5,
        );

        $xPathArray = new XPathArray('/', $data);

        $this->expectException(InvalidTypeException::class);
        $this->expectExceptionMessage('Value for XPath success is no Bool');

        $xPathArray->getBool('success');
    }

    /**
     * This test verifies that we get our
     * correct value if found, even if we
     * provide a default value.
     * @test
     * @author Christian Dangl
     * @throws InvalidTypeException
     * @throws XPathNotFoundException
     */
    public function getBool_with_default_valueFound()
    {
        $data = array(
            'success' => true,
        );

        $xPathArray = new XPathArray('/', $data);

        $value = $xPathArray->getBool('/success', false);

        $this->assertEquals(true, $value);
    }

    /**
     * This test verifies that we get our default
     * value if the real value has not been found.
     * @test
     * @author Christian Dangl
     * @throws InvalidTypeException
     * @throws XPathNotFoundException
     */
    public function getBool_with_default_valueNotFound()
    {
        $data = array(
            'success' => true,
        );

        $xPathArray = new XPathArray('/', $data);

        $value = $xPathArray->getBool('/unknown', false);

        $this->assertEquals(false, $value);
    }

    /**
     * This test verifies that we get our
     * provided default value if the real value is NULL.
     * @test
     * @author Christian Dangl
     * @throws InvalidTypeException
     * @throws XPathNotFoundException
     */
    public function getBool_with_default_valueNull()
    {
        $data = array(
            'success' => null,
        );

        $xPathArray = new XPathArray('/', $data);

        $value = $xPathArray->getBool('/success', false);

        $this->assertEquals(false, $value);
    }

}
