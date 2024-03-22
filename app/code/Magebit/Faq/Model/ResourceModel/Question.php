<?php
namespace Magebit\Faq\Model\ResourceModel;
class Question extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    private const TABLE_NAME = 'magebit_faq_question';
    private const PRIMARY_KEY = 'id';

    protected function _construct()
    {
        $this->_init(self::TABLE_NAME, self::PRIMARY_KEY);
    }
}
