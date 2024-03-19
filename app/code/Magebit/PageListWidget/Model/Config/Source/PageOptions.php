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

namespace Magebit\PageListWidget\Model\Config\Source;

use Exception;
use Magento\Cms\Api\PageRepositoryInterface;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\Data\OptionSourceInterface;
use Psr\Log\LoggerInterface;

class PageOptions implements OptionSourceInterface
{
    /**
     * @var LoggerInterface
     */
    protected LoggerInterface $_logger;

    /**
     * @var SearchCriteriaBuilder
     */
    private SearchCriteriaBuilder $searchCriteriaBuilder;

    /**
     * @var PageRepositoryInterface
     */
    private PageRepositoryInterface $pageRepository;

    public function __construct(
        SearchCriteriaBuilder   $searchCriteriaBuilder,
        PageRepositoryInterface $pageRepository,
        LoggerInterface $logger
    ) {
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        $this->pageRepository = $pageRepository;
        $this->_logger = $logger;
    }

    /**
     * Retrieve CMS pages as options
     *
     * @return array
     */
    public function toOptionArray(): array
    {
        try {
            $searchCriteria = $this->searchCriteriaBuilder->create();
            $pages = $this->pageRepository->getList($searchCriteria)->getItems();

            $options = [];

            foreach ($pages as $page) {
                $options[] = [
                    'value' => $page->getId(),
                    'label' => $page->getTitle()
                ];
            }
            return $options;
        } catch (Exception $e) {
            $this->_logger->critical($e);
            return [];
        }
    }
}
