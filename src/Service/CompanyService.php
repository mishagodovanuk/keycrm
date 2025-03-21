<?php

namespace KeyCrm\Service;

use KeyCrm\Client\HttpClientInterface;
use KeyCrm\Exception\KeyCrmException;
use KeyCrm\Model\Company;

class CompanyService implements CompanyServiceInterface
{
    private HttpClientInterface $httpClient;

    public function __construct(HttpClientInterface $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    public function create(array $data): Company
    {
        $response = $this->httpClient->request('POST', '/companies', ['body' => $data]);
        return $this->mapToCompany($response);
    }

    public function get(int $companyId, array $include = []): Company
    {
        $query = [];
        if (!empty($include)) {
            $query['include'] = implode(',', $include);
        }
        $uri = '/companies/' . $companyId;
        // Optionally append query parameters
        if ($query) {
            $uri .= '?' . http_build_query($query);
        }
        $response = $this->httpClient->request('GET', $uri);
        return $this->mapToCompany($response);
    }

    public function list(array $query = []): array
    {
        $uri = '/companies';
        if ($query) {
            $uri .= '?' . http_build_query($query);
        }
        $response = $this->httpClient->request('GET', $uri);
        // Map response data into an array of Company models
        $companies = [];
        foreach ($response['data'] as $companyData) {
            $companies[] = $this->mapToCompany($companyData);
        }
        return $companies;
    }

    public function update(int $companyId, array $data): Company
    {
        $uri = '/companies/' . $companyId;
        $response = $this->httpClient->request('PUT', $uri, ['body' => $data]);
        return $this->mapToCompany($response);
    }

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
