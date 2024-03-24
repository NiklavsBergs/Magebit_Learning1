<?php
/**
 * This file is part of the Magebit package.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade Magebit Faq
 * to newer versions in the future.
 *
 * @copyright Copyright (c) 2024 Magebit, Ltd. (https://magebit.com/)
 * @license   GNU General Public License ("GPL") v3.0
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Magebit\Faq\Controller\Adminhtml\Question;

use Magebit\Faq\Model\QuestionFactory;
use Magebit\Faq\Model\ResourceModel\Question as QuestionResource;
use Magebit\Faq\Model\ResourceModel\Question\CollectionFactory;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Exception\LocalizedException;
use Magento\Ui\Component\MassAction\Filter;

class MassDelete extends Action implements HttpPostActionInterface
{

    /**
     * @param Context $context
     * @param QuestionResource $resource
     * @param QuestionFactory $questionFactory
     * @param CollectionFactory $collectionFactory
     * @param Filter $filter
     */
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

    /**
     * @return ResultInterface
     * @throws LocalizedException
     */
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
            $this->messageManager->addErrorMessage(__('We can\'t find questions to delete'));
            return $resultRedirect->setPath('*/*/');
        }

        try {
            foreach ($qIds as $qId){
                $model = $this->questionFactory->create();
                $this->resource->load($model, $qId);
                $this->resource->delete($model);
            }

            $this->messageManager->addSuccessMessage(__('The questions have been deleted'));
        }catch (\Throwable $exception){
            $this->messageManager->addErrorMessage($exception->getMessage());
        }

        return $resultRedirect->setPath('*/*/');
    }
}
