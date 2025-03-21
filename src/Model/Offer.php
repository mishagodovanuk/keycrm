<?php

namespace KeyCrm\Model;

class Offer
{
    public int $id;
    public int $product_id;
    public string $sku;
    public string $barcode;
    public string $thumbnail_url;
    public float $price;
    public float $purchased_price;
    public int $quantity;
    public float $weight;
    public float $length;
    public float $width;
    public float $height;
    public array $properties; // Each element: ['name' => string, 'value' => string]

    /**
     * Optional nested product data if "include=product" is specified.
     *
     * @var Product|null
     */
    public ?Product $product = null;
}
