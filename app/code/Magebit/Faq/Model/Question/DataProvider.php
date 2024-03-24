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

    /**
     * @var array
     */
    private array $loadedData;

    /**
     * @param $name
     * @param $primaryFieldName
     * @param $requestFieldName
     * @param CollectionFactory $CollectionFactory
     * @param QuestionResource $resource
     * @param QuestionFactory $questionFactory
     * @param RequestInterface $request
     * @param array $meta
     * @param array $data
     * @param PoolInterface|null $pool
     */
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

    /**
     * @return array
     */
    public function getData(): array
    {
        if (isset($this->loadedData)){
            return $this->loadedData;
        }
        $post = $this->getCurrentQuestion();
        $this->loadedData[$post->getId()] = $post->getData();

        return $this->loadedData;
    }

    /**
     * @return Question
     */
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

    /**
     * @return int
     */
    private function getQuestionId(): int
    {
        return (int) $this->request->getParam($this->getRequestFieldName());
    }

}
