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

namespace Magebit\PageListWidget\Model\Config\source;

use Magebit\PageListWidget\Block\Widget\PageList;
use Magento\Framework\Data\OptionSourceInterface;

class PageOptions implements OptionSourceInterface
{
    /**
     * @var PageList
     */
    protected $pageListBlock;

    /**
     * PageOptions constructor.
     * @param PageList $pageListBlock
     */
    public function __construct(
        PageList $pageListBlock
    ) {
        $this->pageListBlock = $pageListBlock;
    }

    /**
     * Retrieve CMS pages as options
     *
     * @return array
     */
    public function toOptionArray()
    {
        $options = [];

        $pages = $this->pageListBlock->getAllPages();
        foreach ($pages as $page) {
            $options[] = [
                'value' => $page->getId(),
                'label' => $page->getTitle()
            ];
        }
        return $options;
    }
}
