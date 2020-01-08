<?php

namespace Shoppy\ApiOperations;

trait Update
{
    public function update(array $params = NULL) {
        $instance = $this;
        $instance->_update($params);

        return $instance;
    }
}