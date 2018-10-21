<?php

namespace Shoppy\HttpClient;

use Shoppy\Models\ApiResponse;
use Shoppy\Shoppy;

class CurlClient
{
    private static $instance;

    const DEFAULT_TIMEOUT = 80000; // 80 * 1000
    const DEFAULT_CONNECT_TIMEOUT = 30000; // 30 * 1000

    private $timeout = self::DEFAULT_TIMEOUT;
    private $connectTimeout = self::DEFAULT_CONNECT_TIMEOUT;

    public static function instance()
    {
        if (!self::$instance) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public function request($method, $url, $params = [])
    {
        $ch = curl_init();

        $opts = [];

        switch ($method) {
            case 'get':
                $opts[CURLOPT_HTTPGET] = true;
                break;
            case 'post':
                $opts[CURLOPT_POST] = true;
                $opts[CURLOPT_POSTFIELDS] = urlencode($params);
                break;
        }

        $url = Shoppy::$apiBase . $url;

        $opts[CURLOPT_URL] = $url;
        $opts[CURLOPT_HTTPHEADER] = [
            'Authorization: ' . Shoppy::getApiKey(),
        ];
        $opts[CURLOPT_USERAGENT] = 'shoppy-php @ ' . phpversion();
        $opts[CURLOPT_RETURNTRANSFER] = true;
        $opts[CURLOPT_CONNECTTIMEOUT] = $this->connectTimeout;
        $opts[CURLOPT_TIMEOUT] = $this->timeout;
        $opts[CURLOPT_HEADER] = true;

        curl_setopt_array($ch, $opts);

        $data = curl_exec($ch);

        if (!$data) {
            // Handle error
        }

        $rcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $headerSize = curl_getinfo($ch, CURLINFO_HEADER_SIZE);

        $header = substr($data, 0, $headerSize);
        $body = substr($data, $headerSize);

        // Format header
        $headers = [];
        foreach (explode(PHP_EOL, $header) as $i => $line) {
            if ($i === 0) {
                $headers['http_code'] = $line;
                continue;
            }

            $exploded = explode(': ', $line);

            if (count($exploded) === 2) {
                $headers[strtolower($exploded[0])] = $exploded[1];
            }
        }

        $apiResponse = new ApiResponse($body, $rcode, $headers, json_decode($body));

        return $apiResponse;
    }
}