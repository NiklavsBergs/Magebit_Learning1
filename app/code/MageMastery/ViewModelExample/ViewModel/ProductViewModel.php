<?php

namespace MageMastery\ViewModelExample\ViewModel;

use Magento\Catalog\Api\Data\ProductInterface;
use Magento\Framework\View\Element\Block\ArgumentInterface;
use Magento\Tests\NamingConvention\true\resource;

class ProductViewModel implements ArgumentInterface
{
    private Resource $resource;

    public function __construct(Resource $resource)
    {
        $this->resource = $resource;
    }

    public function getProductBySku(string $sku): ProductInterface
    {
        return $this->resource->load($sku, 'sku');
    }
}
