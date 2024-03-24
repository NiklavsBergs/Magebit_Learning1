<?php

namespace Magebit\Faq\Service;

use Magebit\Faq\Model\ResourceModel\Question\Collection;
use Magebit\Faq\Model\ResourceModel\Question\CollectionFactory;
use Magento\Framework\DB\Select;

class QuestionProvider
{
    public function __construct(private CollectionFactory $collectionFactory)
    {}
    public function getQuestions()
    {
        $collection = $this->getCollection();
        $collection->setOrder('position', Select::SQL_ASC);

        return $collection;
    }

    private function getCollection()
    {
        return $this->collectionFactory->create();
    }
}
