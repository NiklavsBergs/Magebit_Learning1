<?php

namespace Magebit\Faq\Block;

class Create extends \Magento\Framework\View\Element\Template
{


    /**
     * Construct
     *
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param array $data
     */
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->pageConfig->getTitle()->set(__('Create Question'));
    }

    public function getStatus($val = '')
    {
        $status =  array(0 => 'Disabled',1 => 'Enabled');
        return ($val != '') ? $status[$val] : $status;
    }
}
