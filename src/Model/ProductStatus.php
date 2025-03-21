<?php

namespace KeyCrm\Model;

class ProductStatus
{
    public int $id;
    public string $name;       // e.g., "Hot"
    public string $alias;      // e.g., "hot"
    public ?int $position;     // e.g., 3
    public bool $is_active;    // e.g., true
    public bool $is_reserved;  // e.g., true
    public string $created_at; // UTC date/time string
    public string $updated_at; // UTC date/time string
}
