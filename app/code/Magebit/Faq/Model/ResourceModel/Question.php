<?php
namespace Magebit\Faq\Model\ResourceModel;
class Question extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    protected function _construct()
    {
        $this->_init('magebit_faq_question', 'id');
    }
}
