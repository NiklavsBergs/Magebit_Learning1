<?php
/**
 * This file is part of the Magebit package.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade Magebit Faq
 * to newer versions in the future.
 *
 * @copyright Copyright (c) 2024 Magebit, Ltd. (https://magebit.com/)
 * @license   GNU General Public License ("GPL") v3.0
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Magebit\Learning\ViewModel;

use Exception;
use Magento\Catalog\Model\ProductRepository;
use Magento\Framework\View\Element\Block\ArgumentInterface;
use Magento\Catalog\Block\Product\View;

class AttributeViewModel implements ArgumentInterface
{
    private string $ATTR_1 = 'dimensions';
    private string $ATTR_2 = 'color';
    private string $ATTR_3 = 'material';

    public function __construct(private ProductRepository $productRepository)
    {}

    public function getAttributes(View $block)
    {
        $product = $block->getProduct();
        return $product->getAttributes();
    }

    /**
     * @param View $block
     * @return array
     */
    public function getAdditionalAttributes(View $block): array
    {
        try {
            $additionalAttributes = [];

            $product = $block->getProduct();
            $attributes = $product->getAttributes();

            foreach($attributes as $attribute){
                if($attribute->getAttributeCode() == $this->ATTR_1){
                    $additionalAttributes[] = [
                        'label' => $attribute->getDefaultFrontendLabel(),
                        'value' => $attribute->getFrontend()->getValue($product)
                        ];
                }
                if($attribute->getAttributeCode() == $this->ATTR_2){
                    $additionalAttributes[] = [
                        'label' => $attribute->getDefaultFrontendLabel(),
                        'value' => $attribute->getFrontend()->getValue($product)
                    ];
                }
                if($attribute->getAttributeCode() == $this->ATTR_3){
                    $additionalAttributes[] = [
                        'label' => $attribute->getDefaultFrontendLabel(),
                        'value' => $attribute->getFrontend()->getValue($product)
                    ];
                }
            }

            return $additionalAttributes;
        } catch (Exception $e) {
            return [];
        }
    }

    /**
     * @param View $block
     * @return string
     */
    public function getShortDescription(View $block): string
    {
        $product = $block->getProduct();

        return $product->getShortDescription();
    }
}
