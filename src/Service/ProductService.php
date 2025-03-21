<?php

namespace KeyCrm\Service;

use KeyCrm\Client\HttpClientInterface;
use KeyCrm\Model\Product;

class ProductService implements ProductServiceInterface
{
    private HttpClientInterface $httpClient;

    public function __construct(HttpClientInterface $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    public function create(array $data): Product
    {
        $response = $this->httpClient->request('POST', '/products', ['body' => $data]);
        return $this->mapToProduct($response);
    }

    public function get(int $productId, array $include = []): Product
    {
        $query = [];
        if (!empty($include)) {
            $query['include'] = implode(',', $include);
        }
        $uri = '/products/' . $productId;
        if ($query) {
            $uri .= '?' . http_build_query($query);
        }
        $response = $this->httpClient->request('GET', $uri);
        return $this->mapToProduct($response);
    }

    public function list(array $query = []): array
    {
        $uri = '/products';
        if ($query) {
            $uri .= '?' . http_build_query($query);
        }
        $response = $this->httpClient->request('GET', $uri);
        $products = [];
        foreach ($response['data'] as $productData) {
            $products[] = $this->mapToProduct($productData);
        }
        return $products;
    }

    public function update(int $productId, array $data): Product
    {
        $uri = '/products/' . $productId;
        $response = $this->httpClient->request('PUT', $uri, ['body' => $data]);
        return $this->mapToProduct($response);
    }

    private function mapToProduct(array $data): Product
    {
        $product = new Product();
        $product->id            = $data['id'];
        $product->name          = $data['name'];
        $product->description   = $data['description'];
        $product->thumbnail_url = $data['thumbnail_url'];
        $product->attachments_data = $data['attachments_data'] ?? [];
        $product->quantity      = $data['quantity'];
        $product->unit_type     = $data['unit_type'] ?? null;
        $product->currency_code = $data['currency_code'];
        $product->sku           = $data['sku'];
        $product->min_price     = $data['min_price'];
        $product->max_price     = $data['max_price'];
        $product->weight        = $data['weight'];
        $product->length        = $data['length'];
        $product->width         = $data['width'];
        $product->height        = $data['height'];
        $product->has_offers    = $data['has_offers'];
        $product->is_archived   = $data['is_archived'];
        $product->category_id   = $data['category_id'];
        $product->created_at    = $data['created_at'];
        $product->updated_at    = $data['updated_at'];
        // Optionally map additional data such as offers, stock, and category if provided.
        return $product;
    }
}
