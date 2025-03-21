<?php

namespace KeyCrm\Client;

interface HttpClientInterface
{
    /**
     * Send an HTTP request.
     *
     * @param string $method HTTP method (GET, POST, etc.)
     * @param string $uri API endpoint URI
     * @param array  $options Request options (headers, body, query params, etc.)
     *
     * @return array Response data as an associative array
     *
     * @throws \KeyCrm\Exception\KeyCrmException on error.
     */
    public function request(string $method, string $uri, array $options = []): array;
}
