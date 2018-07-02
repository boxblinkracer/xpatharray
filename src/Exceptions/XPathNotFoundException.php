<?php

namespace XPathArray\Exceptions;

/**
 * Class XPathNotFoundException
 * @package Services\XPathArray
 */
class XPathNotFoundException extends \Exception
{
    /** @var string */
    private $xPath = '';

    /**
     * XPathNotFoundException constructor.
     * @param string $xpath
     * @author: Christian Dangl
     */
    public function __construct(string $xpath)
    {
        $this->xPath = $xpath;

        parent::__construct("XPath not found: " . $this->xPath);
    }

    /**
     * @return string
     */
    public function getXPath(): string
    {
        return $this->xPath;
    }

}
