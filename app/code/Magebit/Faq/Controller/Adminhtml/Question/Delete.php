<?php

namespace Magebit\Faq\Controller\Adminhtml\Question;


use Magebit\Faq\Model\QuestionFactory;
use Magento\Backend\App\Action;

use Magento\Backend\App\Action\Context;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\Controller\ResultInterface;
use Magebit\Faq\Model\ResourceModel\Question as QuestionResource;

class Delete extends Action implements HttpPostActionInterface
{

    public function __construct(
        Context $context,
        private QuestionResource $resource,
        private QuestionFactory $questionFactory
    )
    {
        parent::__construct($context);
    }

    public function execute(): ResultInterface
    {
        $qId = (int) $this->getRequest()->getParam('id');
        $resultRedirect = $this->resultRedirectFactory->create();
        if (!$qId){
            $this->messageManager->addErrorMessage(__('We can\'t find a question to delete'));
            return $resultRedirect->setPath('*/*/');
        }

        $model = $this->questionFactory->create();

        try {
            $this->resource->load($model, $qId);
            $this->resource->delete($model);

            $this->messageManager->addSuccessMessage(__('The question has been deleted'));
        }catch (\Throwable $exception){
            $this->messageManager->addErrorMessage($exception->getMessage());
        }

        return $resultRedirect->setPath('*/*/');
    }
}
