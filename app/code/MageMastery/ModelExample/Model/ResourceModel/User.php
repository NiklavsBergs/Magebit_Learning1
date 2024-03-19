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

namespace MageMastery\ModelExample\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class User extends AbstractDb
{

    protected function _construct()
    {
        $this->_init('table_name', 'primary_id');
    }

    public function getUsers($status):array
    {
        $connection = $this->resourceModel->getConnection();
        $tableName = $connection->getTableName('table_name');
        $select = $connection->select()
            ->from($tableName)
            ->where('status=?', $status);

        $users = $connection->fetchAll($select);

        return $users;
    }


}
