<?php
namespace Magebit\Faq\Model;

use Magebit\Faq\Model\ResourceModel\Question as QuestionResource;
use Magento\Framework\Model\AbstractModel;

class Question extends AbstractModel
{
    /**
     * @return void
     */
    protected function _construct(): void
    {
        $this->_init(QuestionResource::class);
    }
}
