<?php

namespace MageMastery\ModelExample\Controller;

use MageMastery\ModelExample\Model\User;
use MageMastery\ModelExample\Model\UserFactory;

class Controller
{
    private $userFactory;

    public function __construct(UserFactory $userFactory)
    {
        $this->userFactory = $userFactory;
    }

    public function execute()
    {
        $user = $this->userFactory->create();
        $user->setData('first_name', 'Max');

        $firstName = $user->getData('first_name');
    }
}
