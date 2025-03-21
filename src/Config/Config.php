<?php

namespace KeyCrm\Config;

class Config
{
    private string $baseUrl;
    private string $bearerToken;

    public function __construct(string $baseUrl, string $bearerToken)
    {
        $this->baseUrl     = $baseUrl;
        $this->bearerToken = $bearerToken;
    }

    public function getBaseUrl(): string
    {
        return $this->baseUrl;
    }

    public function getBearerToken(): string
    {
        return $this->bearerToken;
    }
}
