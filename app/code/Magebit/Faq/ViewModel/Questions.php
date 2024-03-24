<?php

namespace Magebit\Faq\ViewModel;

use Magebit\Faq\Model\ResourceModel\Question\Collection;
use Magebit\Faq\Service\QuestionProvider;
use Magento\Framework\View\Element\Block\ArgumentInterface;

class Questions implements ArgumentInterface
{

    public function __construct(private QuestionProvider $questionProvider)
    {}
    public function getQuestions()
    {
        return $this->questionProvider->getQuestions();
    }
}
