<?php

namespace Shoppy\Models;

use Shoppy\HttpClient\CurlClient;

abstract class ApiResource extends ShoppyObject
{
    private $_httpClient;

    public function __construct($id = NULL)
    {
        parent::__construct($id);
        $this->_httpClient = new CurlClient();
    }

    public function refresh($opts = [])
    {
        $response = $this->_httpClient->request('get', $this->instanceUrl($opts));
        $this->apiResponse = $response;

        return $this;
    }

    public function _create($params, $opts = [])
    {
        $response = $this->_httpClient->request('put', $this->classUrl($opts), $params);
        $this->apiResponse = $response;

        return $this;
    }

    public function classUrl($opts)
    {
        $base = get_called_class();
        $class = substr($base, strrpos($base, '\\'));

        $class = str_replace('\\', '', $class);
        $class = strtolower($class);

        $uri = "/v1/${class}s";

        return $uri;
    }

    public function instanceUrl($opts)
    {
        $base = get_called_class();
        $class = substr($base, strrpos($base, '\\'));

        $class = str_replace('\\', '', $class);
        $class = strtolower($class);

        $resourceId = '';

        if ($this->getId()) {
            $resourceId = '/' . $this->getId();
        }

        $uri = "/v1/${class}s${resourceId}";

        if (isset($opts['page'])) {
            $uri .= "?page=${opts['page']}";
        }

        return $uri;
    }

    public function __get($key)
    {
        return $this->apiResponse->json->$key;
    }
}
