<?php

namespace KeyCrm\Service;

use KeyCrm\Model\Product;

interface ProductServiceInterface
{
    public function create(array $data): Product;
    public function get(int $productId, array $include = []): Product;
    public function list(array $query = []): array;
    public function update(int $productId, array $data): Product;
    // Additional methods for import, offers, categories can be added here.
}
