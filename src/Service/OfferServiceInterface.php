<?php

namespace KeyCrm\Service;

use KeyCrm\Model\Offer;

interface OfferServiceInterface
{
    public function list(array $query = []): array;
    public function update(array $data): bool;
    public function getStocks(array $query = []): array;
    public function updateStocks(int $warehouseId, array $stocks): bool;
}
