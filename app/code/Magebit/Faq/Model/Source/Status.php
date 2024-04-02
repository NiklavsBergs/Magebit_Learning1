<?php
namespace Magebit\Faq\Model\Source;

class Status implements \Magento\Framework\Option\ArrayInterface
{
    const DISABLED = 0;

    const ENABLED = 1;

    /**
     * Retrieve status options array.
     *
     * @return array
     */
    public function toOptionArray(): array
    {
        return [
            ['value' => self::DISABLED, 'label' => __('Disabled')],
            ['value' => self::ENABLED, 'label' => __('Enabled')],
        ];
    }
}
