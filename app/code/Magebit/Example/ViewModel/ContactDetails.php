<?php declare(strict_types=1);

namespace Magebit\Example\ViewModel;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\View\Element\Block\ArgumentInterface;

class ContactDetails implements ArgumentInterface
{

        public function __construct(
            private ScopeConfigInterface $scopeConfig,
        ){}

        public function getPhoneNumber(): string
        {
            return (string) $this->scopeConfig->getValue('general/store_information/phone');
        }
}
