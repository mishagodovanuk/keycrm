<?php

namespace KeyCrm\Service;

use KeyCrm\Client\HttpClientInterface;
use KeyCrm\Exception\KeyCrmException;
use KeyCrm\Model\Company;

/**
 * Company service.
 */
class CompanyService implements CompanyServiceInterface
{
    /**
     * @var HttpClientInterface
     */
    private HttpClientInterface $httpClient;

    /**
     * @param HttpClientInterface $httpClient
     */
    public function __construct(HttpClientInterface $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    /**
     * @param array $data
     * @return Company
     * @throws KeyCrmException
     */
    public function create(array $data): Company
    {
        $response = $this->httpClient->request('POST', '/companies', ['body' => $data]);

        return $this->mapToCompany($response);
    }

    /**
     * @param int $companyId
     * @param array $include
     * @return Company
     * @throws KeyCrmException
     */
    public function get(int $companyId, array $include = []): Company
    {
        $query = [];

        if (!empty($include)) {
            $query['include'] = implode(',', $include);
        }
        $uri = '/companies/' . $companyId;

        if ($query) {
            $uri .= '?' . http_build_query($query);
        }
        $response = $this->httpClient->request('GET', $uri);

        return $this->mapToCompany($response);
    }

    /**
     * @param array $query
     * @return array
     * @throws KeyCrmException
     */
    public function list(array $query = []): array
    {
        $uri = '/companies';
        if ($query) {
            $uri .= '?' . http_build_query($query);
        }
        $response = $this->httpClient->request('GET', $uri);
        $companies = [];

        foreach ($response['data'] as $companyData) {
            $companies[] = $this->mapToCompany($companyData);
        }

        return $companies;
    }

    /**
     * @param int $companyId
     * @param array $data
     * @return Company
     * @throws KeyCrmException
     */
    public function update(int $companyId, array $data): Company
    {
        $uri = '/companies/' . $companyId;
        $response = $this->httpClient->request('PUT', $uri, ['body' => $data]);

        return $this->mapToCompany($response);
    }

    /**
     * @param array $data
     * @return Company
     */
    private function mapToCompany(array $data): Company
    {
        $company = new Company();
        $company->id           = $data['id'];
        $company->name         = $data['name'];
        $company->title        = $data['title'] ?? null;
        $company->notes        = $data['notes'] ?? null;
        $company->bank_account = $data['bank_account'] ?? null;
        $company->manager_id   = $data['manager_id'] ?? null;
        $company->custom_fields = $data['custom_fields'] ?? [];
        $company->created_at   = $data['created_at'];
        $company->updated_at   = $data['updated_at'];

        return $company;
    }
}
