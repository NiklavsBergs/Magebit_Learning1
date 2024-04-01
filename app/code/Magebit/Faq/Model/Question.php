<?php
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

    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }

    public function getId()
    {
        return $this->getData('id');
    }

    public function setId($id)
    {
        return $this->setData('id', $id);
    }

    public function getQuestion()
    {
        return $this->getData('question');
    }

    public function setQuestion($question)
    {
        return $this->setData('question', $question);
    }

    public function getAnswer()
    {
        return $this->getData('answer');
    }

    public function setAnswer($answer)
    {
        return $this->setData('answer', $answer);
    }

    public function getStatus()
    {
        return $this->getData('status');
    }

    public function setStatus($status)
    {
        return $this->setData('status', $status);
    }

    public function getPosition()
    {
        return $this->getData('position');
    }

    public function setPosition($position)
    {
        return $this->setData('position', $position);
    }

    public function getUpdatedAt()
    {
        return $this->getData('updated_at');
    }

    public function setUpdatedAt($updatedAt)
    {
        return $this->setData('updated_at', $updatedAt);
    }
}
