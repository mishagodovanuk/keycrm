<?php

namespace KeyCrm\Model;

class Product
{
    public int $id;
    public ?string $name;
    public ?string $description;
    public ?string $thumbnail_url;
    public ?array $attachments_data; // List of image URLs
    public ?int $quantity;
    public ?string $unit_type;      // For example: "кг", or null if using system units
    public ?string $currency_code;
    public ?string $sku;
    public ?float $min_price;
    public ?float $max_price;
    public ?float $weight;
    public ?float $length;
    public ?float $width;
    public ?float $height;
    public ?bool $has_offers;

    public ?int $in_reserve;
    public ?bool $is_archived;
    public ?int $category_id;
    public ?string $created_at;
    public ?string $updated_at;
}
