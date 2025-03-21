# KeyCRM PHP Client

A PHP client module for Key CRM API, built using PHP 8.1 with best practices, SOLID principles, and proper separation of concerns. The module supports companies, products, offers, and categories endpoints.

## Installation

Install via Composer:

```
composer require mihod/keycrm-php-client
```

## Usage Example

Below is an example of how you could use the module to fetch the product with ID 1389. Make sure you’ve installed your package via Composer and set up the autoloader.

```
<?php

require_once __DIR__ . '/vendor/autoload.php';

use KeyCrm\Client\DefaultHttpClient;
use KeyCrm\KeyCrmApi;

// Configure your API base URL and Bearer token
$baseUrl = 'https://openapi.keycrm.app';
$bearerToken = 'YOUR_BEARER_TOKEN_HERE';

// Create an instance of the HTTP client with your configuration
$httpClient = new DefaultHttpClient($baseUrl, $bearerToken);

// Instantiate the API facade
$keyCrmApi = new KeyCrmApi($httpClient);

try {
    // Fetch product with ID 1389.
    // Optionally, you can include additional associations like custom_fields, offers, stocks, etc.
    $product = $keyCrmApi->products()->get(1389, ['custom_fields', 'offers']);
    
    // Output the product data
    echo '<pre>';
    print_r($product);
    echo '</pre>';
} catch (\KeyCrm\Exception\KeyCrmException $e) {
    echo 'Error fetching product: ' . $e->getMessage();
}
```

### HTTP Client Setup:
You instantiate the DefaultHttpClient with the API base URL and your Bearer token for authentication.

### API Facade:
The KeyCrmApi is constructed with the HTTP client. It exposes service methods for companies, products, and offers.

### Fetching the Product:
By calling ```$keyCrmApi->products()->get(1389, ['custom_fields', 'offers'])```, you request the product with ID 1389. The second parameter is optional and lets you specify which associated data should be included in the response (such as custom fields or offers).

### Auth:
Replace ```'YOUR_BEARER_TOKEN_HERE'``` with your actual API token, and adjust the base URL if needed. This example demonstrates a basic usage scenario of your Key CRM PHP client module.

### File Structure
```
key-crm-php-client/
├── src/
│   ├── Client/
│   │   ├── HttpClientInterface.php
│   │   └── DefaultHttpClient.php
│   ├── Config/
│   │   └── Config.php
│   ├── Exception/
│   │   └── KeyCrmException.php
│   ├── Model/
│   │   ├── Company.php
│   │   ├── Category.php
│   │   ├── Product.php
│   │   ├── ProductOffer.php
│   │   ├── ProductStatus.php
│   │   ├── Offer.php
│   │   └── OfferStocks.php
│   ├── Service/
│   │   ├── CompanyServiceInterface.php
│   │   ├── CompanyService.php
│   │   ├── ProductServiceInterface.php
│   │   ├── ProductService.php
│   │   ├── OfferServiceInterface.php
│   │   ├── OfferService.php
│   │   └── CategoryServiceInterface.php
│   └── KeyCrmApi.php
├── tests/
│   └── (test files)
├── composer.json
└── README.md
```

### License
This project is licensed under the MIT License.