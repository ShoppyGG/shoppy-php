<?php

namespace Shoppy\Errors;

class ValidationException extends \Exception
{
    public $errors;

    public function __construct(array $errors = [], $code = 0, \Exception $previous = NULL)
    {
        $this->errors = $errors;
    }
}