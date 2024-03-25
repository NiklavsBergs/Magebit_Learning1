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

namespace Magebit\Faq\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Question extends AbstractDb
{
    private const TABLE_NAME = 'magebit_faq_question';
    private const PRIMARY_KEY = 'id';

    /**
     * @return void
     */
    protected function _construct(): void
    {
        $this->_init(self::TABLE_NAME, self::PRIMARY_KEY);
    }
}