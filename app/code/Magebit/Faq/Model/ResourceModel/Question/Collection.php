<?php

namespace Magebit\Faq\Model\ResourceModel\Question;
class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected $_idFieldName = 'id';
    protected $_eventPrefix = 'magebit_faq_question_collection';
    protected $_eventObject = 'question_collection';

    /**
     * Define resource model
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Magebit\Faq\Model\Question', 'Magebit\Faq\Model\ResourceModel\Question');

    }
}
