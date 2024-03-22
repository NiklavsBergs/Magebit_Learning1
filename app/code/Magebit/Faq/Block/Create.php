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


    /**
     * Get form action URL for POST booking request
     *
     * @return string
     */
    public function getFormAction()
    {
        // companymodule is given in routes.xml
        // controller_name is folder name inside controller folder
        // action is php file name inside above controller_name folder
        return '/faq/create/index';
        // here controller_name is index, action is booking
    }

    public function getStatus($val = '')
    {
        $status =  array(0 => 'Disabled',1 => 'Enabled');
        return ($val != '') ? $status[$val] : $status;
    }
}
