<?php

namespace KeyCrm;

use KeyCrm\Client\HttpClientInterface;
use KeyCrm\Service\CompanyService;
use KeyCrm\Service\CompanyServiceInterface;
use KeyCrm\Service\ProductService;
use KeyCrm\Service\ProductServiceInterface;
use KeyCrm\Service\OfferService;
use KeyCrm\Service\OfferServiceInterface;

class KeyCrmApi
{
    private CompanyServiceInterface $companyService;
    private ProductServiceInterface $productService;
    private OfferServiceInterface $offerService;

    public function __construct(HttpClientInterface $httpClient)
    {
        $this->companyService = new CompanyService($httpClient);
        $this->productService = new ProductService($httpClient);
        $this->offerService   = new OfferService($httpClient);
    }

    public function companies(): CompanyServiceInterface
    {
        return $this->companyService;
    }

    public function products(): ProductServiceInterface
    {
        return $this->productService;
    }

    public function offers(): OfferServiceInterface
    {
        return $this->offerService;
    }
}
