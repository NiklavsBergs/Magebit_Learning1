<?php declare(strict_types=1);

namespace Magebit\Example\ViewModel;

use Magento\Catalog\Api\Data\ProductInterface;
use Magento\Catalog\Api\ProductRepositoryInterface;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\View\Element\Block\ArgumentInterface;

class ProductDetails implements ArgumentInterface
{

        public function __construct(
            private ProductRepositoryInterface $productRepository,
        ){}

    /**
     * @throws NoSuchEntityException
     */
    public function getPhoneNumber(): ProductInterface
        {
            return $this->productRepository->getById(42);
        }
}
