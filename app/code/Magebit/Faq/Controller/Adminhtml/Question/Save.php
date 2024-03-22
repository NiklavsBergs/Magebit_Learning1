<?php

namespace Magebit\Faq\Controller\Adminhtml\Question;

use Magebit\Faq\Model\ResourceModel\Question as QuestionResource;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Exception\LocalizedException;
use Magebit\Faq\Model\QuestionFactory;

/**
 * Class Save
 *
 * @package SyncIt\Brand\Controller\Adminhtml\Brand
 */
class Save extends Action implements HttpPostActionInterface
{
    public function __construct(
        Context $context,
        private QuestionResource $resource,
        private QuestionFactory $questionFactory
    ) {
        parent::__construct($context);
    }

    /**
     * Save action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function execute(): ResultInterface
    {
        $resultRedirect = $this->resultRedirectFactory->create();
        $data = $this->getRequest()->getPostValue();
        if ($data) {
            $model = $this->questionFactory->create();

            if(empty($data['id'])){
                $data['id'] = null;
            }

            $model->setData($data);

            try {
                $this->resource->save($model);
                $this->messageManager->addSuccessMessage(__('You saved the question.'));
                return $resultRedirect->setPath('*/*/');
            }
            catch (LocalizedException $e) {
                $this->messageManager->addExceptionMessage($e);
            } catch (\Exception $e) {
                $this->messageManager->addErrorMessage(__('Something went wrong while saving the question'));
            }
        }
        return $resultRedirect->setPath('*/*/');
    }
}
