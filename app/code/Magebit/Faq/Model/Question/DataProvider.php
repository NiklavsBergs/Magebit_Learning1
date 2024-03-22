<?php
namespace Magebit\Faq\Model\Question;

use Magebit\Faq\Model\Question;
use Magebit\Faq\Model\QuestionFactory;
use Magebit\Faq\Model\ResourceModel\Question as QuestionResource;
use Magento\Framework\App\RequestInterface;
use Magento\Ui\DataProvider\Modifier\PoolInterface;
use Magebit\Faq\Model\ResourceModel\Question\CollectionFactory;
use Magento\Ui\DataProvider\ModifierPoolDataProvider;

class DataProvider extends ModifierPoolDataProvider
{

    private array $loadedData;
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $CollectionFactory,
        private QuestionResource $resource,
        private QuestionFactory $questionFactory,
        private RequestInterface $request,
        array $meta = [],
        array $data = [],
        PoolInterface $pool = null
    ) {
        $this->collection = $CollectionFactory->create();
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data, $pool);
    }

    public function getData(): array
    {
        if (isset($this->loadedData)){
            return $this->loadedData;
        }
        $post = $this->getCurrentQuestion();
        $this->loadedData[$post->getId()] = $post->getData();

        return $this->loadedData;
    }

    private function getCurrentQuestion(): Question
    {
        $qId = $this->getQuestionId();
        $question = $this->questionFactory->create();
        if(!$qId){
            return $question;
        }

        $this->resource->load($question, $qId);

        return $question;
    }

    private function getQuestionId(): int
    {
        return (int) $this->request->getParam($this->getRequestFieldName());
    }

}
