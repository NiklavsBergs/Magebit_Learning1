<?php

namespace Magebit\Faq\Block\Adminhtml\Question\Edit;

use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;
use Magento\Ui\Component\Control\Container;

/**
 * Class SaveButton
 *
 * @package SyncIt\Brand\Block\Adminhtml\Brand\Edit
 */
class Save extends Generic implements ButtonProviderInterface
{

    /**
     * @return array
     */
    public function getButtonData(): array
    {
        return [
            'label' => __('Save'),
            'class' => 'save primary',
            'data_attribute' => [
                'mage-init' => ['button' => ['event' => 'save']],
                'form-role' => 'save',
            ],
            'sort_order' => 20,
//            'class_name' => Container::SPLIT_BUTTON,
//            'options' => $this->getOptions(),
        ];
    }

//    /**
//     * Retrieve options
//     *
//     * @return array
//     */
//    protected function getOptions()
//    {
//        $options[] = [
//            'id_hard' => 'save_and_close',
//            'label' => __('Save & Close'),
//            'data_attribute' => [
//                'mage-init' => ['button' => ['event' => 'save']],
//                'form-role' => 'save',
//            ],
//        ];
//
//        return $options;
//    }
}
