<?php

namespace Magebit\PageListWidget\Block\Widget;

use Exception;
use Magento\Cms\Api\Data\PageInterface;
use Magento\Cms\Api\PageRepositoryInterface;
use Magento\Cms\Helper\Page;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use Magento\Widget\Block\BlockInterface;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Widget\Model\Widget;
use function React\Promise\all;

class PageList extends Template implements BlockInterface
{
    /**
     * @var String (PageList title)
     */
    private $_title;

    /**
     * @var String (PageList mode)
     */
    private $_mode;

    /**
     * @var PageRepositoryInterface
     */
    private $pageRepository;
    /**
     * @var SearchCriteriaBuilder
     */
    private $searchCriteriaBuilder;

    /**
     * @var PageInterface[]|null
     */
    private $_allPages;


    /**
     * Cms page
     *
     * @var \Magento\Cms\Helper\Page
     */
    protected $_cmsPage;

    /**
     * PageList constructor.
     * @param Context $context
     * @param PageRepositoryInterface $pageRepository
     * @param array $data
     */
    public function __construct(
        Context $context,
        PageRepositoryInterface $pageRepository,
        SearchCriteriaBuilder $searchCriteriaBuilder,
        Page $cmsPage,
        array $data = []
    ) {
        $this->pageRepository = $pageRepository;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;

        $this->_allPages = $this->getAllPages();
        $this->_cmsPage = $cmsPage;

        parent::__construct($context, $data);
    }

    /**
     * Retrieve list of all CMS pages
     *
     * @return \Magento\Cms\Api\Data\PageInterface[]
     * @throws LocalizedException
     */
    public function getAllPages()
    {
        $searchCriteria = $this->searchCriteriaBuilder->create();
        return $this->pageRepository->getList($searchCriteria)->getItems();
    }

    /**
     * Get title of list widget
     * @return array|mixed|string|null
     */
    public function getTitle()
    {
        if (!$this->_title) {
            $this->_title = '';
            if ($this->getData('title') !== null) {
                // compare to null used here bc user can specify blank title
                $this->_title = $this->getData('title');
            }
        }
        return $this->_title;
    }

    /**
     * Get display mode of list widget (all or specific)
     * @return array|mixed|null
     */
    public function getMode()
    {
        if (!$this->_mode)
        {
            $this->_mode = $this->getData('display_mode');
        }
        return $this->_mode;
    }

    /**
     *  Retrieves ids of pages chosen to show in list widget and returns pages
     * @return PageInterface[]|null
     */
    public function getChosenPages()
    {
        if($this->getMode() == 'all')
        {
            return $this->_allPages;
        }
        else
        {
            $chosenPagesString = $this->getData('chosen_pages');

            $chosenIds = explode(',', $chosenPagesString);

            $chosenPages = array_filter($this->_allPages, function($page) use ($chosenIds) {
                return in_array($page->getId(), $chosenIds);
            });

            return $chosenPages;
        }
    }

    /**
     * Retrieve page href from page id
     * @param $id
     * @return string|null
     */
    public function getHref($id)
    {
        return $this->_cmsPage->getPageUrl($id);
    }

    protected $_template = "widget/page-list.phtml";

}
