<?php

namespace Tests\XPathArray\DataTypes;

use PHPUnit\Framework\TestCase;
use XPathArray\Exceptions\InvalidTypeException;
use XPathArray\Exceptions\XPathNotFoundException;
use XPathArray\XPathArray;

/**
 * Class IntTest
 * @author Christian Dangl
 * @copyright 2018 by Christian Dangl
 * @package Tests\XPathArray\DataTypes
 */
class IntTest extends TestCase
{

    /**
     * This test verifies that we get
     * the correct xpath value if type is INT
     * @test
     * @author Christian Dangl
     * @throws XPathNotFoundException
     * @throws \XPathArray\Exceptions\InvalidTypeException
     */
    public function getInt_valid_type()
    {
        $data = array(
            'age' => 54,
        );

        $xPathArray = new XPathArray('/', $data);

        /** @var int $value */
        $value = $xPathArray->getInt('age');

        $this->assertInternalType("int", $value);
    }

    /**
     * This test verifies that we get a correct exception
     * if the type is STRING and no INT.
     * @test
     * @author Christian Dangl
     * @throws XPathNotFoundException
     * @throws \XPathArray\Exceptions\InvalidTypeException
     */
    public function getInt_invalid_type_string()
    {
        $data = array(
            'age' => "test",
        );

        $xPathArray = new XPathArray('/', $data);

        $this->expectException(InvalidTypeException::class);
        $this->expectExceptionMessage('Value for XPath age is no Integer');

        $xPathArray->getInt('age');
    }

    /**
     * This test verifies that we get a correct exception
     * if the type is BOOL and no INT.
     * @test
     * @author Christian Dangl
     * @throws XPathNotFoundException
     * @throws \XPathArray\Exceptions\InvalidTypeException
     */
    public function getInt_invalid_type_bool()
    {
        $data = array(
            'age' => false,
        );

        $xPathArray = new XPathArray('/', $data);

        $this->expectException(InvalidTypeException::class);
        $this->expectExceptionMessage('Value for XPath age is no Integer');

        $xPathArray->getInt('age');
    }

    /**
     * This test verifies that we get the real value
     * if found, even if we have provided a default value.
     * @test
     * @author Christian Dangl
     * @throws InvalidTypeException
     * @throws XPathNotFoundException
     */
    public function getInt_with_default_valueFound()
    {
        $data = array(
            'age' => 15,
        );

        $xPathArray = new XPathArray('/', $data);

        $value = $xPathArray->getInt('/age', 0);

        $this->assertEquals(15, $value);
    }

    /**
     * This test verifies that we get the provided
     * default value if the original value has not been found.
     * @test
     * @author Christian Dangl
     * @throws InvalidTypeException
     * @throws XPathNotFoundException
     */
    public function getInt_with_default_valueNotFound()
    {
        $data = array(
            'age' => 15,
        );

        $xPathArray = new XPathArray('/', $data);

        $value = $xPathArray->getInt('/unknown', 0);

        $this->assertEquals(0, $value);
    }

    /**
     * This test verifies that we get the default value
     * if the original xpath value is NULL.
     * @test
     * @author Christian Dangl
     * @throws InvalidTypeException
     * @throws XPathNotFoundException
     */
    public function getInt_with_default_valueNull()
    {
        $data = array(
            'age' => null,
        );

        $xPathArray = new XPathArray('/', $data);

        $value = $xPathArray->getInt('/age', 0);

        $this->assertEquals(0, $value);
    }

}
