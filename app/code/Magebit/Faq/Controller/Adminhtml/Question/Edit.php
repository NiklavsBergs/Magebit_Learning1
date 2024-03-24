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

namespace Magebit\Faq\Controller\Adminhtml\Question;

use Aws\ResultInterface;
use Magento\Backend\App\Action;
use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\View\Result\Page;

class Edit extends Action implements HttpGetActionInterface
{
    /**
     * @return Page
     */
    public function execute(): Page
    {
        $pageResult = $this->createPageResult();
        $title = $pageResult->getConfig()->getTitle();
        $title->prepend(__('FAQ Question'));

        return $pageResult;
    }

    /**
     * @return Page|ResultInterface
     */
    private function createPageResult(): Page|ResultInterface
    {
        return $this->resultFactory->create(ResultFactory::TYPE_PAGE);
    }
}
