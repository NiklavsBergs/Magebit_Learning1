<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Magebit\Faq\Block\Adminhtml\Question\Edit;

use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;

/**
 * Class Back
 */
class Back extends Generic implements ButtonProviderInterface
{
    /**
     * Get Button Data
     *
     * @return array
     */
    public function getButtonData(): array
    {
        return [
            'label' => __('Back'),
            'on_click' => sprintf("location.href = '%s';", $this->getBackUrl()),
            'class' => 'back',
            'sort_order' => 10
        ];
    }
    /**
     * Get URL for back
     *
     * @return string
     */
    private function getBackUrl(): string
    {
        return $this->getUrl('*/*/');
    }
}