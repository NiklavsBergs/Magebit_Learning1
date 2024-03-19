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

class PageList extends Template implements BlockInterface
{
    protected $_template = "widget/page-list.phtml";

    /**
     * @var PageRepositoryInterface
     */
    private PageRepositoryInterface $pageRepository;
    /**
     * @var SearchCriteriaBuilder
     */
    private SearchCriteriaBuilder $searchCriteriaBuilder;

    /**
     * Cms page
     *
     * @var Page
     */
    protected $_cmsPage;

    /**
     * PageList constructor.
     * @param Context $context
     * @param PageRepositoryInterface $pageRepository
     * @param array $data
     */
    public function __construct(
        Context                 $context,
        PageRepositoryInterface $pageRepository,
        SearchCriteriaBuilder   $searchCriteriaBuilder,
        Page                    $cmsPage,
        array                   $data = []
    ) {
        $this->pageRepository = $pageRepository;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;

        $this->_cmsPage = $cmsPage;

        parent::__construct($context, $data);
    }

    /**
     * Retrieve list of all CMS pages
     *
     * @return PageInterface[]
     * @throws LocalizedException
     */
    public function getAllPages(): array
    {
        $searchCriteria = $this->searchCriteriaBuilder->create();
        return $this->pageRepository->getList($searchCriteria)->getItems();
    }

    /**
     * Get title of list widget
     * @return string
     */
    public function getTitle(): string
    {
        if ($this->getData('title') !== null) {
            return $this->getData('title');
        }

        return '';
    }

    /**
     * Get display mode of list widget (all or specific)
     * @return string
     */
    public function getMode(): string
    {
        return $this->_mode = $this->getData('display_mode');
    }

    /**
     *  Retrieves ids of pages chosen to show in list widget and returns pages
     * @return PageInterface[]|null
     */
    public function getChosenPages(): ?array
    {
        try {
            if ($this->getMode() == 'all') {
                return $this->getAllPages();
            } else {
                $chosenPagesString = $this->getData('chosen_pages');

                $chosenIds = explode(',', $chosenPagesString);

                $searchCriteria = $this->searchCriteriaBuilder
                    ->addFilter('page_id', $chosenIds, 'in')
                    ->create();

                return $this->pageRepository->getList($searchCriteria)->getItems();
            }
        } catch (Exception $e) {
            $this->_logger->critical($e);
            return null;
        }
    }

    /**
     * Retrieve page href from page id
     * @param $id
     * @return string|null
     */
    public function getHref($id): ?string
    {
        return $this->_cmsPage->getPageUrl($id);
    }
}
