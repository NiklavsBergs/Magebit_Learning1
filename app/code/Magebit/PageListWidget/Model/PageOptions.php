<?php

namespace Magebit\PageListWidget\Model;

use Magebit\PageListWidget\Block\Widget\PageList;
use \Magento\Framework\Data\OptionSourceInterface;

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
