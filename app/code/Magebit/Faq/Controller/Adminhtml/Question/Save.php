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

use Magebit\Faq\Api\QuestionRepositoryInterface;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Exception\LocalizedException;
use Magebit\Faq\Model\QuestionFactory;

class Save extends Action implements HttpPostActionInterface
{
    /**
     * @var QuestionRepositoryInterface
     */
    private QuestionRepositoryInterface $questionRepository;

    /**
     * @var QuestionFactory
     */
    private QuestionFactory $questionFactory;

    /**
     * @param Context $context
     * @param QuestionFactory $questionFactory
     * @param QuestionRepositoryInterface $questionRepository
     */
    public function __construct(
        Context $context,
        QuestionFactory $questionFactory,
        QuestionRepositoryInterface $questionRepository,
    ) {
        $this->questionRepository=$questionRepository;
        $this->questionFactory=$questionFactory;
        parent::__construct($context);
    }

    /**
     * Save action
     *
     * @return ResultInterface
     * @throws LocalizedException
     */
    public function execute(): ResultInterface
    {
        $resultRedirect = $this->resultRedirectFactory->create();
        $data = $this->getRequest()->getPostValue();

        $redirectBack = $this->getRequest()->getParam('back', false);

        if ($data) {
            $model = $this->questionFactory->create();

            if(empty($data['id'])){
                $data['id'] = null;
            }

            $data['updated_at'] = date('Y-m-d H:i:s');

            $model->setData($data);

            try {
                $this->questionRepository->save($model);
                $this->messageManager->addSuccessMessage(__('You saved the question.'));

                if (!$redirectBack) {
                    return $resultRedirect->setPath('*/*/');
                }

                return $resultRedirect->setPath('*/*/edit', ['id' => $model->getId()]);
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
