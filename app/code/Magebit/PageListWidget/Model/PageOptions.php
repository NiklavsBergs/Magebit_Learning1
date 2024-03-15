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
        return $this->pageListBlock->getCmsPagesOptions();
    }
}
