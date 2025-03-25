<?php

namespace KeyCrm\Service;

use KeyCrm\Client\HttpClientInterface;
use KeyCrm\Exception\KeyCrmException;
use KeyCrm\Model\Category;

/**
 * Category service.
 */
class CategoryService implements CategoryServiceInterface
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
     * Get product categories.
     *
     * @param array $query Query parameters (e.g., limit, page, filter)
     * @param bool $fetchAllPages If true, returns all pages; if false, returns only the specified page.
     * @return Category[] Array of Category objects.
     * @throws KeyCrmException
     */
    public function list(array $query = [], bool $fetchAllPages = true): array
    {
        if (!$fetchAllPages) {
            $uri = '/products/categories?' . http_build_query($query);
            $response = $this->httpClient->request('GET', $uri);
            $categories = [];

            foreach ($response['data'] as $catData) {
                $category = new Category();
                $category->id        = $catData['id'];
                $category->name      = $catData['name'];
                $category->parent_id = $catData['parent_id'] ?? null;
                $categories[] = $category;
            }
            return $categories;
        } else {
            $allCategories = [];
            $page = $query['page'] ?? 1;
            $limit = $query['limit'] ?? 15;

            do {
                $query['page'] = $page;
                $query['limit'] = $limit;
                $uri = '/products/categories?' . http_build_query($query);
                $response = $this->httpClient->request('GET', $uri);

                foreach ($response['data'] as $catData) {
                    $category = new Category();
                    $category->id        = $catData['id'];
                    $category->name      = $catData['name'];
                    $category->parent_id = $catData['parent_id'] ?? null;
                    $allCategories[] = $category;
                }

                $hasNextPage = isset($response['next_page_url']) && !empty($response['next_page_url']);
                $page++;
            } while ($hasNextPage);

            return $allCategories;
        }
    }
}
