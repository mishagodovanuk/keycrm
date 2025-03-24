<?php

namespace KeyCrm\Config;

/**
 * Config.
 */
class Config
{
    /**
     * Default api url.
     */
    public const DEFAULT_API_URL = 'https://openapi.keycrm.app/v1';
    /**
     * @var string
     */
    private string $baseUrl;
    /**
     * @var string
     */
    private string $bearerToken;

    /**
     * @param string $baseUrl
     * @param string $bearerToken
     */
    public function __construct(string $baseUrl, string $bearerToken)
    {
        $this->baseUrl     = $baseUrl ?: self::DEFAULT_API_URL;
        $this->bearerToken = $bearerToken;
    }

    /**
     * @return string
     */
    public function getBaseUrl(): string
    {
        return $this->baseUrl;
    }

    /**
     * @return string
     */
    public function getBearerToken(): string
    {
        return $this->bearerToken;
    }
}
