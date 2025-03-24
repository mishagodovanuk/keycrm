<?php

namespace KeyCrm;

use KeyCrm\Client\HttpClientInterface;
use KeyCrm\Service\CompanyService;
use KeyCrm\Service\CompanyServiceInterface;
use KeyCrm\Service\ProductService;
use KeyCrm\Service\ProductServiceInterface;
use KeyCrm\Service\OfferService;
use KeyCrm\Service\OfferServiceInterface;

/**
 * KeyCrm Api.
 */
class KeyCrmApi
{
    /**
     * @var CompanyService|CompanyServiceInterface
     */
    private CompanyServiceInterface|CompanyService $companyService;
    /**
     * @var ProductService|ProductServiceInterface
     */
    private ProductServiceInterface|ProductService $productService;
    /**
     * @var OfferService|OfferServiceInterface
     */
    private OfferServiceInterface|OfferService $offerService;

    /**
     * @param HttpClientInterface $httpClient
     */
    public function __construct(HttpClientInterface $httpClient)
    {
        $this->companyService = new CompanyService($httpClient);
        $this->productService = new ProductService($httpClient);
        $this->offerService   = new OfferService($httpClient);
    }

    /**
     * @return CompanyServiceInterface
     */
    public function companies(): CompanyServiceInterface
    {
        return $this->companyService;
    }

    /**
     * @return ProductServiceInterface
     */
    public function products(): ProductServiceInterface
    {
        return $this->productService;
    }

    /**
     * @return OfferServiceInterface
     */
    public function offers(): OfferServiceInterface
    {
        return $this->offerService;
    }
}
