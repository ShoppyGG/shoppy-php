<?php

namespace Shoppy\Models;

use Shoppy\Errors\ApiException;

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
     */
    public function __construct($body, $code, $headers, $json)
    {
        $this->body = $body;
        $this->code = $code;
        $this->headers = $headers;
        $this->json = $json;

        if(isset($json->error) && !$json->status) {
            throw new ApiException($json->error->message, $json->error->code);
        }
    }
}