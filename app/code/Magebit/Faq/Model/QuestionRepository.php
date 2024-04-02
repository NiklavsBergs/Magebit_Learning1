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

namespace Magebit\Faq\Model;

use Magebit\Faq\Api\Data\QuestionInterface;
use Magebit\Faq\Api\QuestionRepositoryInterface;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Api\SearchResultsInterfaceFactory;

use Magebit\Faq\Model\ResourceModel\Question as QuestionResourceModel;
use Magebit\Faq\Model\ResourceModel\Question\CollectionFactory;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;

class QuestionRepository implements QuestionRepositoryInterface{

    /**
     * @var \Magebit\Faq\Model\QuestionFactory
     */
    protected \Magebit\Faq\Model\QuestionFactory $questionFactory;
    /**
     * @var QuestionResourceModel
     */
    protected QuestionResourceModel $questionResourceModel;
    /**
     * @var CollectionFactory
     */
    protected CollectionFactory $collectionFactory;
    /**
     * @var SearchResultsInterfaceFactory
     */
    protected SearchResultsInterfaceFactory $searchResultsFactory;

    /**
     * QuestionInterface constructor.
     *
     * @param QuestionFactory $questionFactory
     * @param QuestionResourceModel $questionResourceModel
     * @param CollectionFactory $collectionFactory
     * @param SearchResultsInterfaceFactory $searchResultsFactory
     */
    public function __construct(
        QuestionFactory $questionFactory,
        QuestionResourceModel $questionResourceModel,
        CollectionFactory $collectionFactory,
        SearchResultsInterfaceFactory $searchResultsFactory
    ) {
        $this->questionFactory        = $questionFactory;
        $this->questionResourceModel  = $questionResourceModel;
        $this->collectionFactory    = $collectionFactory;
        $this->searchResultsFactory = $searchResultsFactory;
    }

    /**
     * @param QuestionInterface $question
     * @return QuestionInterface
     * @throws CouldNotSaveException
     */
    public function save(QuestionInterface $question)
    {
        try {
            $this->questionResourceModel->save($question);
        } catch (\Exception $e) {
            throw new CouldNotSaveException(__($e->getMessage()));
        }
        return $question;
    }

    /**
     * @param $id
     * @return Question
     * @throws NoSuchEntityException
     */
    public function getById($id): Question
    {
        $question = $this->questionFactory->create();
        $this->questionResourceModel->load($question, $id);
        if (!$question->getId()) {
            throw new NoSuchEntityException(__('Question with id "%1" does not exist.', $id));
        }
        return $question;
    }

    /**
     * @param SearchCriteriaInterface $criteria
     * @return QuestionResourceModel\Collection|mixed
     */
    public function getList(SearchCriteriaInterface $criteria)
    {
        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setSearchCriteria($criteria);
        $collection = $this->collectionFactory->create();
        foreach ($criteria->getFilterGroups() as $filterGroup) {
            $fields = [];
            $conditions = [];
            foreach ($filterGroup->getFilters() as $filter) {
                $condition = $filter->getConditionType() ? $filter->getConditionType() : 'eq';
                $fields[] = $filter->getField();
                $conditions[] = [$condition => $filter->getValue()];
            }
            if ($fields) {
                $collection->addFieldToFilter($fields, $conditions);
            }
        }
        $sortOrders = $criteria->getSortOrders();
        if ($sortOrders) {

            foreach ($sortOrders as $sortOrder) {
                $collection->addOrder(
                    $sortOrder->getField(),
                    ($sortOrder->getDirection() == $sortOrders) ? 'ASC' : 'DESC'
                );
            }
        }
        $collection->setCurPage($criteria->getCurrentPage());
        $collection->setPageSize($criteria->getPageSize());
        return $collection;
    }

    /**
     * @param QuestionInterface $question
     * @return true
     * @throws CouldNotDeleteException
     */
    public function delete(QuestionInterface $question)
    {
        try {
            $this->questionResourceModel->delete($question);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__($exception->getMessage()));
        }
        return true;
    }

    /**
     * @param $id
     * @return true
     * @throws CouldNotDeleteException
     * @throws NoSuchEntityException
     */
    public function deleteById($id)
    {
        return $this->delete($this->getById($id));
    }
}
