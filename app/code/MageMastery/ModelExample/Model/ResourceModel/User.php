<?php

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
