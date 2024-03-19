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
use Magento\Framework\View\Element\Block\ArgumentInterface;
use Magento\Catalog\Block\Product\View\Attributes;

class AttributeViewModel implements ArgumentInterface
{
    /**
     * @param Attributes $block
     * @return array
     */
    public function getAdditionalAttributes(Attributes $block): array
    {
        try {
            return $block->getAdditionalData();
        } catch (Exception $e) {
            return [];
        }
    }

    /**
     * @param Attributes $block
     * @return string
     */
    public function getShortDescription(Attributes $block): string
    {
        $product = $block->getProduct();

        return $product->getShortDescription();
    }
}
