<?php

namespace KeyCrm\Service;

use KeyCrm\Model\Offer;

/**
 * Offer service interface.
 */
interface OfferServiceInterface
{
    /**
     * @param array $query
     * @return array
     */
    public function list(array $query = []): array;

    /**
     * @param array $data
     * @return bool
     */
    public function update(array $data): bool;

    /**
     * @param array $query
     * @return array
     */
    public function getStocks(array $query = []): array;

    /**
     * @param int $warehouseId
     * @param array $stocks
     * @return bool
     */
    public function updateStocks(int $warehouseId, array $stocks): bool;
}
