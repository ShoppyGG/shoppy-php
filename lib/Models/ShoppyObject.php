<?php

namespace Shoppy\Models;

class ShoppyObject implements \Countable
{
    private $_id;

    public function __construct($id)
    {
        $this->_id = $id;
    }

    public function getId()
    {
        return $this->_id;
    }

    /**
     * Count elements of an object
     * @link http://php.net/manual/en/countable.count.php
     * @return int The custom count as an integer.
     * </p>
     * <p>
     * The return value is cast to an integer.
     * @since 5.1.0
     */
    public function count()
    {
        if (!isset($this->apiResponse->headers['x-total-pages'])) {
            return intdiv((int)$this->apiResponse->headers['x-total-items'], (int)$this->apiResponse->headers['x-items-per-page']);
        }

        return intval($this->apiResponse->headers['x-total-pages']) ?? 1;
    }

    public function toArray($recursive = false)
    {
        return (array)$this->apiResponse->json;
    }
}
