<?php

namespace MageMastery\ModelExample\Model;

use Magento\Framework\Model\AbstractModel;

class User extends AbstractModel
{
    protected function _construct()
    {
        $this->_init(UserResource::class);
    }
}
