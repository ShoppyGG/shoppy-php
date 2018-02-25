<?php

namespace Shoppy\Models;

use Shoppy\HttpClient\CurlClient;

abstract class ApiResource extends ShoppyObject
{
    private $_httpClient;

    public function __construct($id)
    {
        parent::__construct($id);
        $this->_httpClient = new CurlClient();
    }

    public function refresh()
    {
        $response = $this->_httpClient->request('get', $this->instanceUrl());

        foreach($response->json as $key => $value) {
            $this->{$key} = $value;
        }

        return $this;
    }

    public function instanceUrl()
    {
        $base = get_called_class();
        $class = substr($base, strrpos($base, '\\'));

        $class = str_replace('\\', '', $class);
        $class = strtolower($class);

        $resourceId = $this->getId();

        return "/1.0/${class}s/${resourceId}";
    }
}
