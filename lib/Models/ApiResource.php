<?php

namespace Shoppy\Models;

use Shoppy\HttpClient\CurlClient;

abstract class ApiResource extends ShoppyObject
{
    public $_httpClient;

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

    public function _update($params, $opts = []) {
        $response = $this->_httpClient->request('post', $this->instanceUrl($opts), $params);
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

    public function instanceUrl($opts, $action = null)
    {
        $base = get_called_class();
        $class = substr($base, strrpos($base, '\\'));

        $class = str_replace('\\', '', $class);
        $class = strtolower($class);

        $resourceId = '';

        if ($this->getId()) {
            $resourceId = '/' . $this->getId();
        }

        // fix inconsistency naming in API v1
        {
            if ($class === 'query' && !$action) {
                $class = 'querie';
            }

            $pluralSign = "s";

            if ($class === 'query' && $action) {
                $pluralSign = null;
            }
        }

        $uri = "/v1/${class}{$pluralSign}${resourceId}";

        if ($action) {
            $uri .= "/" . strtolower($action);
        }

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
