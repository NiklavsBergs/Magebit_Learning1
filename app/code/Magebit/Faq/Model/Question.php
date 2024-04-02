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

namespace Magebit\Faq\Model;

use Magebit\Faq\Api\Data\QuestionInterface;
use Magebit\Faq\Model\ResourceModel\Question as QuestionResource;
use Magento\Framework\DataObject\IdentityInterface;
use Magento\Framework\Model\AbstractModel;

class Question extends AbstractModel implements QuestionInterface, IdentityInterface
{
    const CACHE_TAG = 'magebit_faq_question';

    /**
     * @return void
     */
    protected function _construct(): void
    {
        $this->_init(QuestionResource::class);
    }

    /**
     * @return string[]
     */
    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }

    /**
     * @return array|mixed|null
     */
    public function getId()
    {
        return $this->getData('id');
    }

    /**
     * @param $id
     * @return Question|mixed
     */
    public function setId($id)
    {
        return $this->setData('id', $id);
    }

    /**
     * @return array|mixed|null
     */
    public function getQuestion()
    {
        return $this->getData('question');
    }

    /**
     * @param $question
     * @return Question|mixed
     */
    public function setQuestion($question)
    {
        return $this->setData('question', $question);
    }

    /**
     * @return array|mixed|null
     */
    public function getAnswer()
    {
        return $this->getData('answer');
    }

    /**
     * @param $answer
     * @return Question|mixed
     */
    public function setAnswer($answer)
    {
        return $this->setData('answer', $answer);
    }

    /**
     * @return array|mixed|null
     */
    public function getStatus()
    {
        return $this->getData('status');
    }

    /**
     * @param $status
     * @return Question|mixed
     */
    public function setStatus($status)
    {
        return $this->setData('status', $status);
    }

    /**
     * @return array|mixed|null
     */
    public function getPosition()
    {
        return $this->getData('position');
    }

    /**
     * @param $position
     * @return Question|mixed
     */
    public function setPosition($position)
    {
        return $this->setData('position', $position);
    }

    /**
     * @return array|mixed|null
     */
    public function getUpdatedAt()
    {
        return $this->getData('updated_at');
    }

    /**
     * @param $updatedAt
     * @return Question|mixed
     */
    public function setUpdatedAt($updatedAt)
    {
        return $this->setData('updated_at', $updatedAt);
    }
}
