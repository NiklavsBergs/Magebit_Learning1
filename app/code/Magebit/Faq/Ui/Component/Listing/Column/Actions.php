<?php
namespace Magebit\Faq\Ui\Component\Listing\Column;

use Magento\Framework\Escaper;
use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Ui\Component\Listing\Columns\Column;
use Magento\Framework\UrlInterface;

class Actions extends Column {
    /** Url path */
    const URL_PATH_EDIT = 'faq/question/edit';

    /** Url path */
    const URL_PATH_DELETE = 'faq/question/delete';

    public function __construct(
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        private UrlInterface $urlBuilder,
        private Escaper $escaper,
        array $components = [],
        array $data = []
    )
    {
        parent::__construct($context, $uiComponentFactory, $components, $data);
    }

    /**
     * Prepare Data Source
     *
     * @param array $dataSource
     * @return array
     */
    public function prepareDataSource(array $dataSource): array
    {
        if (isset($dataSource['data']['items'])) {
            foreach ($dataSource['data']['items'] as &$item) {
                if (isset($item['id'])) {
                    $name = $this->getData('name');
                    $item[$name]['edit'] = [
                        'href' => $this->getEditUrl($item),
                        'label' => __('Edit') ];

                    $title = $this->escaper->escapeHtml($item['id']);

                    $item[$name]['delete'] = [
                        'href' => $this->getDeleteUrl($item),
                        'label' => __('Delete'),
                        'confirm' => [
                            'title' => __('Delete Question %1', $title),
                            'message' => __('Are you sure you want to delete question with id %1', $title)
                        ],
                        'post' => true
                    ];
                }
            }
        }
        return $dataSource;
    }

    private function getEditUrl(array $item): string
    {
        return $this->urlBuilder->getUrl(self::URL_PATH_EDIT, ['id' => $item['id']]);
    }

    private function getDeleteUrl(array $item): string
    {
        return $this->urlBuilder->getUrl(self::URL_PATH_DELETE, ['id' => $item['id']]);
    }
}
