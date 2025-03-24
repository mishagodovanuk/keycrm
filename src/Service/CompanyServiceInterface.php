<?php

namespace KeyCrm\Service;

use KeyCrm\Model\Company;

/**
 * Company service interface.
 */
interface CompanyServiceInterface
{
    /**
     * @param array $data
     * @return Company
     */
    public function create(array $data): Company;

    /**
     * @param int $companyId
     * @param array $include
     * @return Company
     */
    public function get(int $companyId, array $include = []): Company;

    /**
     * @param array $query
     * @return array
     */
    public function list(array $query = []): array;

    /**
     * @param int $companyId
     * @param array $data
     * @return Company
     */
    public function update(int $companyId, array $data): Company;
}
