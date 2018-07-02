<?php

namespace Tests\XPathArray\Services;

use PHPUnit\Framework\TestCase;
use XPathArray\Exceptions\InvalidTypeException;
use XPathArray\Exceptions\XPathNotFoundException;
use XPathArray\Services\XPathParser;
use XPathArray\XPathArray;


/**
 * Class XPathParserTest
 * @author Christian Dangl
 * @copyright dasistweb GmbH (http://www.dasistweb.de)
 * @package Tests\XPathArray\Services
 */
class XPathParserTest extends TestCase
{

    /**
     * This test verifies that we use
     * our delimiter when searching.
     * @test
     * @throws XPathNotFoundException
     * @author: Christian Dangl
     */
    public function verify_delimiter_is_used()
    {
        $data = array(
            'address' => array(
                'street' => 'Super Street',
            )
        );

        $xPathArray = new XPathParser('\\');

        /** @var string $value */
        $value = $xPathArray->getValue('\\address\\street', $data);

        $this->assertEquals('Super Street', $value);
    }

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
     * This test verifies that we can load
     * a simple element value from root
     * by providing a leading slash.
     * @test
     * @throws XPathNotFoundException
     * @author: Christian Dangl
     */
    public function get_simple_element_leading_slash()
    {
        $data = array(
            'firstname' => 'Christian'
        );

        $xPathArray = new XPathParser('/');

        /** @var string $value */
        $value = $xPathArray->getValue('/firstname', $data);

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

        $xPathArray = new XPathParser('/');

        /** @var string $value */
        $value = $xPathArray->getValue('/address/street', $data);

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

        $xPathArray = new XPathParser('/');

        $this->expectException(XPathNotFoundException::class);

        $xPathArray->getValue('/unknown', $data);
    }

}
