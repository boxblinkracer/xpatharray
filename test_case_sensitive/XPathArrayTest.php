<?php

namespace Tests\XPathArray;

use PHPUnit\Framework\TestCase;
use XPathArray\Exceptions\InvalidTypeException;
use XPathArray\Exceptions\XPathNotFoundException;
use XPathArray\XPathArray;


/**
 * Class XPathArrayTest
 * @author Christian Dangl
 * @copyright 2018 by Christian Dangl
 * @package Tests\XPathArray
 */
class XPathArrayTest extends TestCase
{

    /**
     * This test verifies that we can load a simple
     * element value from root without providing a leading slash.
     * @test
     * @author: Christian Dangl
     * @throws XPathNotFoundException
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
     * This test verifies that we can get a complex
     * value from a sub node by using our xpath string.
     * @test
     * @author: Christian Dangl
     * @throws XPathNotFoundException
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
     * @author: Christian Dangl
     * @throws XPathNotFoundException
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
     * This test verifies that we really get the
     * expected element, even if we are using xpath
     * including the default mode. We do not
     * want the default code, because we find the real value.
     * @test
     * @author: Christian Dangl
     * @throws XPathNotFoundException
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
     * This test verifies that we get the provided
     * default value if we try to access a node
     * that does not exist in our array.
     * @test
     * @author: Christian Dangl
     * @throws XPathNotFoundException
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
     * This test verifies that we get the default value
     * if our xpath node exists, but has NULL as value.
     * @test
     * @author: Christian Dangl
     * @throws XPathNotFoundException
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

}
