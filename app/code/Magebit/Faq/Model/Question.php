<?php
namespace Magebit\Faq\Model;
class Question extends \Magento\Framework\Model\AbstractModel implements \Magento\Framework\DataObject\IdentityInterface {
    const CACHE_TAG = 'magebit_faq_question';
    protected $_cacheTag = 'magebit_faq_question';
    protected $_eventPrefix = 'magebit_faq_question';
    protected function _construct() {
        $this->_init('Magebit\Faq\Model\ResourceModel\Question');
    }
    public function getIdentities() {
        return [self::CACHE_TAG . '_' . $this->getId() ];
    }
    public function getDefaultValues() {
        $values = [];
        return $values;
    }
}
