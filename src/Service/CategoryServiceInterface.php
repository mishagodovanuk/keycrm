<?php

namespace KeyCrm\Service;

use KeyCrm\Model\Category;

/**
 * Category service interface.
 */
interface CategoryServiceInterface
{
    /**
     * Get a paginated list of product categories.
     *
     * @param array $query Query parameters (e.g., limit, page, filter)
     * @return Category[] Array of Category objects
     */
    public function list(array $query = []): array;


}
