<?php

namespace Shoppy\ApiOperations;

trait All
{
    public static function all($page = 1)
    {
        $instance = new static();

        $instance->refresh([
            'page' => $page
        ]);

        return $instance;
    }
}