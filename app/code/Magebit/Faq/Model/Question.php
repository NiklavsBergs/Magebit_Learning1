<?php
namespace Magebit\Faq\Model;

use Magebit\Faq\Model\ResourceModel\Question as QuestionResource;

class Question extends \Magento\Framework\Model\AbstractModel{
    protected function _construct() {
        $this->_init(QuestionResource::class);
    }
}
