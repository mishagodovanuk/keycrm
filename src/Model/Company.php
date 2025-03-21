<?php

namespace KeyCrm\Model;

class Company
{
    public int $id;
    public string $name;
    public ?string $title;
    public ?string $notes;
    public ?string $bank_account;
    public ?int $manager_id;
    public array $custom_fields = [];
    public string $created_at;
    public string $updated_at;

    // You can add constructor, getters, setters, or static factory methods as needed.
}
