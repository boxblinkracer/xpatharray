<?php

namespace XPathArray\Services;

use XPathArray\Exceptions\XPathNotFoundException;


/**
 * Class XPathParser
 * @author Christian Dangl
 * @package XPathArray\Services
 */
class XPathParser
{

    /** @var string */
    private $delimiter = null;


    /**
     * XPathParser constructor.
     * @param string $delimiter
     */
    public function __construct(string $delimiter)
    {
        $this->delimiter = $delimiter;
    }

    /**
     * @author Christian Dangl
     * @param string $xpath
     * @param array $data
     * @return array|mixed
     * @throws XPathNotFoundException
     */
    public function getValue(string $xpath, array $data)
    {
        /** @var array $keys */
        $keys = array_filter(explode($this->delimiter, $xpath));

        /** @var array $currentNode */
        $currentNode = $data;

        /** @var string $key */
        foreach ($keys as $key) {

            if (!is_array($currentNode)) {
                throw new XPathNotFoundException($xpath);
            }

            if (array_key_exists($key, $currentNode)) {
                $currentNode = $currentNode[$key];
            } else {
                throw new XPathNotFoundException($xpath);
            }
        }

        return $currentNode;
    }

}
