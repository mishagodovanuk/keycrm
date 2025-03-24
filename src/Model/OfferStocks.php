<?php

namespace KeyCrm\Model;

class OfferStocks
{
    public int $id;
    public ?string $sku;
    public ?float $price;
    public ?float $purchased_price;
    public ?int $quantity;
    public ?int $reserve;

    /**
     * List of warehouses with stock details.
     * Each warehouse can be represented as an associative array with keys:
     * - id, name, quantity, reserve.
     *
     * @var array
     */
    public array $warehouse;
}
