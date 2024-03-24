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

namespace Magebit\Faq\Block;

use Magento\Framework\View\Element\Template;
use Magento\Backend\Block\Template\Context;

class Create extends Template
{
    /**
     * Construct
     * @param Context $context
     * @param array $data
     */
    public function __construct(
        Context $context,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->pageConfig->getTitle()->set(__('Create Question'));
    }

    /**
     * @param string $val
     * @return array|string
     */
    public function getStatus($val = '')
    {
        $status =  array(0 => 'Disabled',1 => 'Enabled');
        return ($val != '') ? $status[$val] : $status;
    }
}
