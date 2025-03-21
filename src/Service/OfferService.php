<?php

namespace KeyCrm\Service;

use KeyCrm\Client\HttpClientInterface;

class OfferService implements OfferServiceInterface
{
    private HttpClientInterface $httpClient;

    public function __construct(HttpClientInterface $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    public function list(array $query = []): array
    {
        $uri = '/offers';
        if ($query) {
            $uri .= '?' . http_build_query($query);
        }
        $response = $this->httpClient->request('GET', $uri);
        // Map each offer data to a model if desired.
        return $response['data'];
    }

    public function update(array $data): bool
    {
        $response = $this->httpClient->request('PUT', '/offers', ['body' => $data]);
        return $response['status'] ?? false;
    }

    public function getStocks(array $query = []): array
    {
        $uri = '/offers/stocks';
        if ($query) {
            $uri .= '?' . http_build_query($query);
        }
        $response = $this->httpClient->request('GET', $uri);
        return $response['data'];
    }

    public function updateStocks(int $warehouseId, array $stocks): bool
    {
        $body = [
            'warehouse_id' => $warehouseId,
            'stocks'       => $stocks,
        ];
        $response = $this->httpClient->request('PUT', '/offers/stocks', ['body' => $body]);
        return $response['status'] ?? false;
    }
}
