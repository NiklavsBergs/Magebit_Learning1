<?php

namespace Magebit\Faq\Controller\Adminhtml\Question;

use Magebit\Faq\Model\ResourceModel\Question as QuestionResource;
use Magebit\Faq\Model\ResourceModel\Question\CollectionFactory;
use Magento\Backend\App\Action;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magebit\Faq\Model\QuestionFactory;
use Magento\Framework\Controller\Result\JsonFactory;

class InlineEdit extends Action implements HttpPostActionInterface
{

    public function __construct(
        Action\Context $context,
        private JsonFactory $resultJsonFactory,
        private QuestionResource $resource,
        private CollectionFactory $collectionFactory,
        private QuestionFactory $questionFactory,
    ) {
        parent::__construct($context);
    }

    /**
     * Inline edit action execute
     *
     * @return \Magento\Framework\Controller\Result\Json
     * @throws \Magento\Framework\Exception\LocalizedException
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function execute()
    {
        $resultJson = $this->resultJsonFactory->create();

        $postItems = $this->getRequest()->getParam('items', []);
        if (!($this->getRequest()->getParam('isAjax') && count($postItems))) {
            return $resultJson->setData(
                [
                    'messages' => [
                        __('Please correct the data sent.')
                    ],
                    'error' => true,
                ]
            );
        }

        try{
            foreach (array_keys($postItems) as $questionId) {
                $model = $this->questionFactory->create();
                $this->resource->load($model, $questionId);
                $model->setData($postItems[$questionId]);
                $this->resource->save($model);
            }
        }catch (\Throwable $exception){
            return $resultJson->setData(
                [
                    'messages' => [$exception],
                    'error' => true,
                ]
            );
        }

        return $resultJson->setData(
            [
                'messages' => [__('Questions saved.')],
                'error' => false,
            ]
        );
    }
}
