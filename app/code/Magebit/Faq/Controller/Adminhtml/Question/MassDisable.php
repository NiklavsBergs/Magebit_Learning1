<?php

namespace Magebit\Faq\Controller\Adminhtml\Question;

use Magebit\Faq\Model\QuestionFactory;
use Magebit\Faq\Model\ResourceModel\Question as QuestionResource;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\Controller\ResultInterface;
use Magento\Ui\Component\MassAction\Filter;
use Magebit\Faq\Model\ResourceModel\Question\CollectionFactory;

class MassDisable extends Action implements HttpPostActionInterface
{
    public function __construct(
        Context $context,
        private QuestionResource $resource,
        private QuestionFactory $questionFactory,
        private CollectionFactory $collectionFactory,
        private Filter $filter
    )
    {
        parent::__construct($context);
    }

    public function execute(): ResultInterface
    {
        $resultRedirect = $this->resultRedirectFactory->create();

        $qIds = [];

        if($this->getRequest()->getParam('selected')){
            $qIds = (array) $this->getRequest()->getParam('selected');
        }
        // For select all
        else if($this->getRequest()->getParam('excluded')){
            $collection = $this->filter->getCollection($this->collectionFactory->create());
            $qIds = $collection->getAllIds();
        }
        else{
            $this->messageManager->addErrorMessage(__('We can\'t find questions to disable'));
            return $resultRedirect->setPath('*/*/');
        }

        try {
            foreach ($qIds as $qId){
                $model = $this->questionFactory->create();
                $this->resource->load($model, $qId);
                $data = $model->getData();
                $data['status'] = '0';
                $model->setData($data);
                $this->resource->save($model);
            }

            $this->messageManager->addSuccessMessage(__('The questions have been disabled'));
        }catch (\Throwable $exception){
            $this->messageManager->addErrorMessage($exception->getMessage());
        }

        return $resultRedirect->setPath('*/*/');
    }
}
