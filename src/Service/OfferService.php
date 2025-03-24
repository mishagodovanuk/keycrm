<?php

namespace KeyCrm\Service;

use KeyCrm\Client\HttpClientInterface;
use KeyCrm\Exception\KeyCrmException;

/**
 * Offer service.
 */
class OfferService implements OfferServiceInterface
{
    /**
     * @var HttpClientInterface
     */
    private HttpClientInterface $httpClient;

    /**
     * @param HttpClientInterface $httpClient
     */
    public function __construct(HttpClientInterface $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    /**
     * @param array $query
     * @return array
     * @throws KeyCrmException
     */
    public function list(array $query = []): array
    {
        $uri = '/offers';

        if ($query) {
            $uri .= '?' . http_build_query($query);
        }

        $response = $this->httpClient->request('GET', $uri);

        return $response['data'];
    }

    /**
     * @param array $data
     * @return bool
     * @throws KeyCrmException
     */
    public function update(array $data): bool
    {
        $response = $this->httpClient->request('PUT', '/offers', ['body' => $data]);

        return $response['status'] ?? false;
    }

    /**
     * @param array $query
     * @return array
     * @throws KeyCrmException
     */
    public function getStocks(array $query = []): array
    {
        $uri = '/offers/stocks';

        if ($query) {
            $uri .= '?' . http_build_query($query);
        }

        $response = $this->httpClient->request('GET', $uri);

        return $response['data'];
    }

    /**
     * @param int $warehouseId
     * @param array $stocks
     * @return bool
     * @throws KeyCrmException
     */
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
