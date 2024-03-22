<?php

namespace Magebit\Faq\Ui\Component\Listing\Column;

class Update extends \Magento\Ui\Component\Listing\Columns\Column
{

    /**
     * @param \Magento\Framework\View\Element\UiComponent\ContextInterface $context
     * @param \Magento\Framework\View\Element\UiComponentFactory $uiComponentFactory
     * @param \Magento\Directory\Api\CountryInformationAcquirerInterface $countryInformation
     * @param array $components
     * @param array $data
     */


    /**
     * Prepare Data Source
     *
     * @param array $dataSource
     * @return array
     */
    public function prepareDataSource(array $dataSource)
    {
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $blockInstance = $objectManager->get('Magebit\Faq\Block\Create');
        $status = $blockInstance->getStatus();
        if (isset($dataSource['data']['items'])) {
            foreach ($dataSource['data']['items'] as & $item) {
                $item['status'] = $status[$item['status']];
            }
        }
        return $dataSource;
    }
}
