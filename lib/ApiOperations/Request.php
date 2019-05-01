<?php

namespace Shoppy\ApiOperations;

trait Request
{
    /**
     * @param null $params
     * @throws \Exception
     */
    protected static function _validateParams($params = NULL)
    {
        if ($params && !is_array($params)) {
            throw new \Exception("You must pass an array as the first argument.");
        }
    }
}