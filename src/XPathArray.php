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
        # no default provided, so use pass
        # on our exceptions without catching it
        if ($default === null) {
            return $this->parser->getValue($xpath, $this->data);
        }

        # if we have a default, make sure to catch
        # the not found exception and return the default
        try {
            $value = $this->parser->getValue($xpath, $this->data);

            if ($value !== null) {
                return $value;
            } else {
                return $default;
            }

        } catch (XPathNotFoundException $ex) {
            return $default;
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
        # no default provided, so use pass
        # on our exceptions without catching it
        if ($default === null) {
            $value = $this->parser->getValue($xpath, $this->data);

            if (is_int($value)) {
                return (int)$value;
            }

            throw new InvalidTypeException('Value for XPath is no Integer');
        }

        # if we have a default, make sure to catch
        # the not found exception and return the default
        try {
            $value = $this->parser->getValue($xpath, $this->data);

            if (is_int($value)) {
                return (int)$value;
            }

            return $default;

        } catch (XPathNotFoundException $ex) {
            return $default;
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
        # no default provided, so use pass
        # on our exceptions without catching it
        if ($default === null) {
            $value = $this->parser->getValue($xpath, $this->data);

            if (is_string($value)) {
                return (string)$value;
            }

            throw new InvalidTypeException('Value for XPath is no String');
        }

        # if we have a default, make sure to catch
        # the not found exception and return the default
        try {
            $value = $this->parser->getValue($xpath, $this->data);

            if (is_string($value)) {
                return (string)$value;
            }

            return $default;

        } catch (XPathNotFoundException $ex) {
            return $default;
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
        # no default provided, so use pass
        # on our exceptions without catching it
        if ($default === null) {
            $value = $this->parser->getValue($xpath, $this->data);

            if ($value === 1) {
                return true;
            } else if ($value === 0) {
                return false;
            }

            if (is_bool($value)) {
                return (bool)$value;
            }

            throw new InvalidTypeException('Value for XPath is no Bool');
        }

        # if we have a default, make sure to catch
        # the not found exception and return the default
        try {
            $value = $this->parser->getValue($xpath, $this->data);

            if ($value === 1) {
                return true;
            } else if ($value === 0) {
                return false;
            }

            if (is_bool($value)) {
                return (bool)$value;
            }

            return $default;

        } catch (XPathNotFoundException $ex) {
            return $default;
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
        # no default provided, so use pass
        # on our exceptions without catching it
        if ($default === null) {
            $value = $this->parser->getValue($xpath, $this->data);

            if (is_float($value)) {
                return (float)$value;
            }

            throw new InvalidTypeException('Value for XPath is no Float');
        }

        # if we have a default, make sure to catch
        # the not found exception and return the default
        try {
            $value = $this->parser->getValue($xpath, $this->data);

            if (is_float($value)) {
                return (float)$value;
            }

            return $default;

        } catch (XPathNotFoundException $ex) {
            return $default;
        }
    }

}
