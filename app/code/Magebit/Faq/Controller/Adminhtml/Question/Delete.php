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

class Delete extends Action implements HttpPostActionInterface
{
    /**
     * @var QuestionRepositoryInterface
     */
    private QuestionRepositoryInterface $questionRepository;

    /**
     * @param Context $context
     * @param QuestionRepositoryInterface $questionRepository
     */
    public function __construct(
        Context $context,
        QuestionRepositoryInterface $questionRepository,
    )
    {
        $this->questionRepository=$questionRepository;
        parent::__construct($context);
    }

    /**
     * @return ResultInterface
     */
    public function execute(): ResultInterface
    {
        $qId = (int) $this->getRequest()->getParam('id');
        $resultRedirect = $this->resultRedirectFactory->create();
        if (!$qId){
            $this->messageManager->addErrorMessage(__('We can\'t find a question to delete'));
            return $resultRedirect->setPath('*/*/');
        }

        try {
            $this->questionRepository->deleteById($qId);
            $this->messageManager->addSuccessMessage(__('The question has been deleted'));
        }catch (\Throwable $exception){
            $this->messageManager->addErrorMessage($exception->getMessage());
        }

        return $resultRedirect->setPath('*/*/');
    }
}
