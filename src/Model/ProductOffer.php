<?php

namespace KeyCrm\Model;

class ProductOffer
{
    public int $id;
    public string $name;
    public string $description;
    public string $thumbnail_url;
    public array $attachments_data; // List of image URLs
    public int $quantity;
    public ?string $unit_type;      // For example: "кг" or null
    public string $currency_code;
    public string $sku;
    public float $min_price;
    public float $max_price;
    public float $weight;
    public float $length;
    public float $width;
    public float $height;
    public bool $has_offers;
    public bool $is_archived;
    public array $properties_agg;   // Associative array: property name => list of values
    public int $category_id;
    public string $created_at;
    public string $updated_at;
}
