<?php

namespace KeyCrm\Model;

class Category
{
    public int $id;
    public ?string $name;
    public ?int $parent_id; // Null for root categories
}
