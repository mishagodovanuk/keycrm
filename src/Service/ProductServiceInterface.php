<?php

namespace KeyCrm\Service;

use KeyCrm\Model\Product;

/**
 * Product service interface.
 */
interface ProductServiceInterface
{
    /**
     * @param array $data
     * @return Product
     */
    public function create(array $data): Product;

    /**
     * @param int $productId
     * @param array $include
     * @return Product
     */
    public function get(int $productId, array $include = []): Product;

    /**
     * @param array $query
     * @return array
     */
    public function list(array $query = []): array;

    /**
     * @param int $productId
     * @param array $data
     * @return Product
     */
    public function update(int $productId, array $data): Product;
}
