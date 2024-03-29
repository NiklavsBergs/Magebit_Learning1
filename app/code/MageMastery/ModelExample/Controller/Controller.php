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

namespace MageMastery\ModelExample\Controller;

use MageMastery\ModelExample\Model\UserFactory;

class Controller
{
    private $userFactory;

    public function __construct(UserFactory $userFactory)
    {
        $this->userFactory = $userFactory;
    }

    public function execute(): void
    {
        $user = $this->userFactory->create();
        $user->setData('first_name', 'Max');

        $firstName = $user->getData('first_name');
    }
}
