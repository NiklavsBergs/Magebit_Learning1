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
