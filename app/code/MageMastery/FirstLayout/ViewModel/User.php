<?php

namespace MageMastery\FirstLayout\ViewModel;

use Magento\Framework\View\Element\Block\ArgumentInterface;

Class User implements ArgumentInterface
{
    Private String $name = 'Friend';

    public function getFirstName():String {
        return $this->name;
    }
}
