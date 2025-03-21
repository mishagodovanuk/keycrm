<?php

namespace KeyCrm\Client;

use KeyCrm\Exception\KeyCrmException;

class DefaultHttpClient implements HttpClientInterface
{
    private string $baseUrl;
    private string $bearerToken;

    public function __construct(string $baseUrl, string $bearerToken)
    {
        $this->baseUrl     = rtrim($baseUrl, '/');
        $this->bearerToken = $bearerToken;
    }

    public function request(string $method, string $uri, array $options = []): array
    {
        $url = $this->baseUrl . '/' . ltrim($uri, '/');
        $headers = $options['headers'] ?? [];
        // Add the Bearer token authentication
        $headers['Authorization'] = 'Bearer ' . $this->bearerToken;
        $headers['Accept'] = 'application/json';

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array_map(
            fn($k, $v) => "$k: $v",
            array_keys($headers),
            $headers
        ));

        if (isset($options['body'])) {
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($options['body']));
            // For JSON content
            $headers['Content-Type'] = 'application/json';
        }

        $response = curl_exec($ch);
        $error    = curl_error($ch);
        $status   = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($error) {
            throw new KeyCrmException("HTTP request failed: $error");
        }

        $data = json_decode($response, true);

        if ($status >= 400) {
            throw new KeyCrmException("HTTP error $status: " . ($data['message'] ?? 'Unknown error'));
        }

        return $data;
    }
}
