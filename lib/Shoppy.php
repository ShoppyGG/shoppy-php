<?php

namespace Shoppy;

/**
 * Class Shoppy
 *
 * @package Shoppy
 */
class Shoppy
{
    /**
     * @var
     */
    public static $apiKey;

    /**
     * @var string
     */
    public static $apiBase = "https://shoppy.gg/api";

    /**
     * @var string
     */
    public static $apiVersion = NULL;

    const VERSION = "1.0";

    /**
     * Get The API key used for requests.
     *
     * @return string
     */
    public static function getApiKey()
    {
        return self::$apiKey;
    }

    /**
     * Sets the API key to be used for requests.
     *
     * @param $apiKey
     */
    public static function setApiKey($apiKey)
    {
        self::$apiKey = $apiKey;
    }
}