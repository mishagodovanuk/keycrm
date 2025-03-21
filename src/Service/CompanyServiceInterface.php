<?php

namespace KeyCrm\Service;

use KeyCrm\Model\Company;

interface CompanyServiceInterface
{
    public function create(array $data): Company;
    public function get(int $companyId, array $include = []): Company;
    public function list(array $query = []): array; // Return paginated data
    public function update(int $companyId, array $data): Company;
}
