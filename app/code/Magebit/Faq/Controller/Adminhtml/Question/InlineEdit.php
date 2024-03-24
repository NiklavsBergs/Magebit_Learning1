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

use Magebit\Faq\Model\ResourceModel\Question as QuestionResource;
use Magebit\Faq\Model\ResourceModel\Question\CollectionFactory;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magebit\Faq\Model\QuestionFactory;
use Magento\Framework\Controller\Result\JsonFactory;

class InlineEdit extends Action implements HttpPostActionInterface
{

    /**
     * @param Context $context
     * @param JsonFactory $resultJsonFactory
     * @param QuestionResource $resource
     * @param CollectionFactory $collectionFactory
     * @param QuestionFactory $questionFactory
     */
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
