<?php

namespace Shoppy\ApiOperations;

trait Create
{
    /**
     * @param array $params
     * @param null $options
     * @return Create
     */
    public static function create(array $params = NULL, $options = NULL)
    {
        $instance = new static();
        $instance->_create($params, $options);

        return $instance;
    }
}