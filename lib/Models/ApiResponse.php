<?php

namespace Shoppy\Models;

use Shoppy\Errors\ApiException;
use Shoppy\Errors\RatelimitationException;
use Shoppy\Errors\ValidationException;

/**
 * Class ApiResponse
 * @package Shoppy\Models
 */
class ApiResponse
{
    public $headers;
    public $body;
    public $json;
    public $code;

    /**
     * ApiResponse constructor.
     * @param $body
     * @param $code
     * @param $headers
     * @param $json
     * @throws ApiException
     * @throws ValidationException
     * @throws RatelimitationException
     */
    public function __construct($body, $code, $headers, $json)
    {
        $this->body = $body;
        $this->code = $code;
        $this->headers = $headers;
        $this->json = $json;

        if (isset($json->error) && !$json->status) {
            throw new ApiException($json->error->message, $json->error->code);
        }

        if (isset($json->errors)) {
            throw new ValidationException((array)$json->errors);
        }

        if (isset($this->code) && $this->code === 429) {
            throw new RatelimitationException();
        }
    }
}