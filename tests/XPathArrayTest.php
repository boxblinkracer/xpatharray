<?php

namespace Tests\XPathArray;

use PHPUnit\Framework\TestCase;
use XPathArray\Exceptions\InvalidTypeException;
use XPathArray\Exceptions\XPathNotFoundException;
use XPathArray\XPathArray;


/**
 * Class XPathArrayTest
 * @author Christian Dangl
 * @package Tests\XPathArray
 */
class XPathArrayTest extends TestCase
{

    /**
     * This test verifies that we can load
     * a simple element value from root
     * without providing a leading slash.
     * @test
     * @throws XPathNotFoundException
     * @author: Christian Dangl
     */
    public function get_simple_element()
    {
        $data = array(
            'firstname' => 'Christian'
        );

        $xPathArray = new XPathArray('/', $data);

        /** @var string $value */
        $value = $xPathArray->get('firstname');

        $this->assertEquals('Christian', $value);
    }

    /**
     * This test verifies that we can get
     * a complex value from a sub node by using
     * our xpath string.
     * @test
     * @throws XPathNotFoundException
     * @author: Christian Dangl
     */
    public function get_complex_element()
    {
        $data = array(
            'address' => array(
                'street' => 'Super Street',
            )
        );

        $xPathArray = new XPathArray('/', $data);

        /** @var string $value */
        $value = $xPathArray->get('/address/street');

        $this->assertEquals('Super Street', $value);
    }

    /**
     * This test verifies that we get a correct
     * exception when our xpath value is not found.
     * @test
     * @throws XPathNotFoundException
     * @author: Christian Dangl
     */
    public function get_not_found_exception()
    {
        $data = array(
            'address' => array(
                'street' => 'Super Street',
            )
        );

        $xPathArray = new XPathArray('/', $data);

        $this->expectException(XPathNotFoundException::class);

        $xPathArray->get('/unknown');
    }

    /**
     * @test
     * @throws XPathNotFoundException
     * @author: Christian Dangl
     */
    public function get_with_default_valueFound()
    {
        $data = array(
            'address' => 'Street',
        );

        $xPathArray = new XPathArray('/', $data);

        $value = $xPathArray->get('/address', '-');

        $this->assertEquals('Street', $value);
    }

    /**
     * @test
     * @throws XPathNotFoundException
     * @author: Christian Dangl
     */
    public function get_with_default_valueNotFound()
    {
        $data = array(
            'address' => 'Street',
        );

        $xPathArray = new XPathArray('/', $data);

        $value = $xPathArray->get('/unknown', '-');

        $this->assertEquals('-', $value);
    }

    /**
     * @test
     * @throws XPathNotFoundException
     * @author: Christian Dangl
     */
    public function get_with_default_valueNull()
    {
        $data = array(
            'address' => null,
        );

        $xPathArray = new XPathArray('/', $data);

        $value = $xPathArray->get('/address', '-');

        $this->assertEquals('-', $value);
    }

    /**
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
        $this->expectExceptionMessage('Value for XPath is no Integer');

        $xPathArray->getInt('age');
    }

    /**
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
        $this->expectExceptionMessage('Value for XPath is no Integer');

        $xPathArray->getInt('age');
    }

    /**
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

    /**
     * @test
     * @author Christian Dangl
     * @throws XPathNotFoundException
     * @throws \XPathArray\Exceptions\InvalidTypeException
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
        $this->expectExceptionMessage('Value for XPath is no String');

        $xPathArray->getString('name');
    }

    /**
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
        $this->expectExceptionMessage('Value for XPath is no String');

        $xPathArray->getString('name');
    }

    /**
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

    /**
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
        $this->expectExceptionMessage('Value for XPath is no Bool');

        $xPathArray->getBool('success');
    }

    /**
     * @test
     * @author Christian Dangl
     * @throws XPathNotFoundException
     * @throws \XPathArray\Exceptions\InvalidTypeException
     */
    public function getBool_valid_type_int_true()
    {
        $data = array(
            'success' => 1,
        );

        $xPathArray = new XPathArray('/', $data);

        /** @var bool $value */
        $value = $xPathArray->getBool('success');

        $this->assertInternalType("bool", $value);
        $this->assertEquals(true, $value);
    }

    /**
     * @test
     * @author Christian Dangl
     * @throws XPathNotFoundException
     * @throws \XPathArray\Exceptions\InvalidTypeException
     */
    public function getBool_valid_type_int_false()
    {
        $data = array(
            'success' => 0,
        );

        $xPathArray = new XPathArray('/', $data);

        /** @var bool $value */
        $value = $xPathArray->getBool('success');

        $this->assertInternalType("bool", $value);
        $this->assertEquals(false, $value);
    }

    /**
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
        $this->expectExceptionMessage('Value for XPath is no Bool');

        $xPathArray->getBool('success');
    }

    /**
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

    /**
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
        $this->expectExceptionMessage('Value for XPath is no Float');

        $xPathArray->getFloat('amount');
    }

    /**
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
        $this->expectExceptionMessage('Value for XPath is no Float');

        $xPathArray->getFloat('amount');
    }

    /**
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
