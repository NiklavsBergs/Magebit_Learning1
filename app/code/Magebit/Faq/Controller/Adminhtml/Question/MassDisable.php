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
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Exception\LocalizedException;

class MassDisable extends Action implements HttpPostActionInterface
{

    /**
     * @var QuestionRepositoryInterface
     */
    private QuestionRepositoryInterface $questionRepository;
    /**
     * @var SearchCriteriaBuilder
     */
    private SearchCriteriaBuilder $searchCriteriaBuilder;

    /**
     * @param Context $context
     * @param QuestionRepositoryInterface $questionRepository
     * @param SearchCriteriaBuilder $searchCriteriaBuilder
     */
    public function __construct(
        Context $context,
        QuestionRepositoryInterface $questionRepository,
        SearchCriteriaBuilder $searchCriteriaBuilder
    )
    {
        $this->questionRepository=$questionRepository;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
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
            $questions = $this->questionRepository->getList($this->searchCriteriaBuilder->create());
            $qIds = $questions->getAllIds();
        }
        else{
            $this->messageManager->addErrorMessage(__('We can\'t find questions to disable'));
            return $resultRedirect->setPath('*/*/');
        }

        try {
            foreach ($qIds as $qId){
                $question = $this->questionRepository->getById($qId);
                $data = $question->getData();
                $data['status'] = '0';
                $question->setData($data);
                $this->questionRepository->save($question);
            }

            $this->messageManager->addSuccessMessage(__('The questions have been disabled'));
        }catch (\Throwable $exception){
            $this->messageManager->addErrorMessage($exception->getMessage());
        }

        return $resultRedirect->setPath('*/*/');
    }
}
