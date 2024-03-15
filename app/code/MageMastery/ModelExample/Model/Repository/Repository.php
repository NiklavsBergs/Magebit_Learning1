<?php

namespace MageMastery\ModelExample\Model\Repository;

use MageMastery\ModelExample\Model\ResourceModel\User;
use Magento\User\Api\Data\UserInterface;

class Repository
{
    private $resourceModel;

    public function __construct(User $resourceModel)
    {
        $this->resourceModel = $resourceModel;
    }

    public function getById($id)
    {
        $user = $this->resourceModel->load($id);
    }

    public function delete($id): bool
    {
        return $this->resourceModel->delete($id);
    }

    public function save($id): UserInterface
    {
        return $this->resourceModel->save($id);
    }
}
