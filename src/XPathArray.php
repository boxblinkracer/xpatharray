<?php

namespace XPathArray;

use XPathArray\Exceptions\InvalidTypeException;
use XPathArray\Exceptions\XPathNotFoundException;
use XPathArray\Services\XPathParser;


/**
 * Class XPathArray
 * @author Christian Dangl
 * @package XPathArray
 */
class XPathArray
{

    /** @var XPathParser */
    private $parser = null;

    /** @var array */
    private $data = null;


    /**
     * XPathArray constructor.
     * @param string $delimiter
     * @param array $data
     * @author: Christian Dangl
     */
    public function __construct(string $delimiter, array $data)
    {
        $this->parser = new XPathParser($delimiter);
        $this->data = $data;
    }


    /**
     * @author Christian Dangl
     * @param string $xpath
     * @param null $default
     * @return array|mixed
     * @throws XPathNotFoundException
     */
    public function get(string $xpath, $default = null)
    {
        try {

            $value = $this->parser->getValue($xpath, $this->data);

            if ($default !== null && $value === null) {
                return $default;
            }

            return $value;

        } catch (XPathNotFoundException $ex) {

            if ($default === null) {
                throw $ex;
            } else {
                return $default;
            }
        }
    }

    /**
     * @author Christian Dangl
     * @param string $xpath
     * @param int|null $default
     * @return int
     * @throws InvalidTypeException
     * @throws XPathNotFoundException
     */
    public function getInt(string $xpath, int $default = null): int
    {
        try {

            $value = $this->parser->getValue($xpath, $this->data);

            if (is_int($value)) {
                return (int)$value;
            }

            if ($default === null) {
                throw new InvalidTypeException('Value for XPath ' . $xpath . ' is no Integer');
            }

            return $default;

        } catch (XPathNotFoundException $ex) {

            if ($default === null) {
                throw $ex;
            } else {
                return $default;
            }
        }
    }

    /**
     * @author Christian Dangl
     * @param string $xpath
     * @param string|null $default
     * @return string
     * @throws InvalidTypeException
     * @throws XPathNotFoundException
     */
    public function getString(string $xpath, string $default = null): string
    {
        try {

            $value = $this->parser->getValue($xpath, $this->data);

            if (is_string($value)) {
                return (string)$value;
            }

            if ($default === null) {
                throw new InvalidTypeException('Value for XPath ' . $xpath . ' is no String');
            }

            return $default;

        } catch (XPathNotFoundException $ex) {

            if ($default === null) {
                throw $ex;
            } else {
                return $default;
            }
        }
    }

    /**
     * @author Christian Dangl
     * @param string $xpath
     * @param bool|null $default
     * @return bool
     * @throws InvalidTypeException
     * @throws XPathNotFoundException
     */
    public function getBool(string $xpath, bool $default = null): bool
    {
        try {

            $value = $this->parser->getValue($xpath, $this->data);

            if ($value === 1) {
                return true;
            } else if ($value === 0) {
                return false;
            }

            if (strtoupper($value) === "TRUE") {
                return true;
            } else if (strtoupper($value) === "FALSE") {
                return false;
            }

            if (is_bool($value)) {
                return (bool)$value;
            }

            if ($default === null) {
                throw new InvalidTypeException('Value for XPath ' . $xpath . ' is no Bool');
            }

            return $default;

        } catch (XPathNotFoundException $ex) {

            if ($default === null) {
                throw $ex;
            } else {
                return $default;
            }
        }
    }

    /**
     * @author Christian Dangl
     * @param string $xpath
     * @param float|null $default
     * @return float
     * @throws InvalidTypeException
     * @throws XPathNotFoundException
     */
    public function getFloat(string $xpath, float $default = null): float
    {
        try {

            $value = $this->parser->getValue($xpath, $this->data);

            if (is_float($value)) {
                return (float)$value;
            }

            if ($default === null) {
                throw new InvalidTypeException('Value for XPath ' . $xpath . ' is no Float');
            }

            return $default;

        } catch (XPathNotFoundException $ex) {

            if ($default === null) {
                throw $ex;
            } else {
                return $default;
            }
        }
    }

}
