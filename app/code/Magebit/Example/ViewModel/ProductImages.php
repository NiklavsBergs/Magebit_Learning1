<?php declare(strict_types=1);

namespace Magebit\Example\ViewModel;

use Magento\Catalog\Api\ProductRepositoryInterface;
use Magento\Catalog\Block\Product\ImageFactory;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\View\Element\Block\ArgumentInterface;

class ProductImages implements  ArgumentInterface
{
    public function __construct(
        private ProductRepositoryInterface $productRepository,
        private SearchCriteriaBuilder $searchCriteriaBuilder,
        private ImageFactory $imageFactory
    )
    {}

    public function getImages()
    {

        $this->searchCriteriaBuilder->setPageSize(4);
        $searchCriteria = $this->searchCriteriaBuilder->create();
        $searchResults = $this->productRepository->getList($searchCriteria);

        $products = $searchResults->getItems();

        $productImages = [];
        foreach ($products as $product) {
            $productImage = $this->imageFactory->create($product, 'product_swatch_image_medium');

            $productImages[] = [
                'src' => $productImage->getImageUrl(),
                'alt' => $product->getName(),
                'caption' => $product->getName()
            ];
        }

        return $productImages;
    }
}
