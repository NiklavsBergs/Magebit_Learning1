<?php

namespace Magebit\Faq\Block\Adminhtml\Question\Edit;

use Magento\Framework\UrlInterface;

/**
 * Class GenericButton
 *
 * @package SyncIt\Brand\Block\Adminhtml\Brand\Edit
 */
abstract class Generic
{

    protected $context;

    /**
     * @param UrlInterface $url
     */
    public function __construct(
        private UrlInterface $url
    )
    {}

    /**
     * Generate url by route and parameters
     *
     * @param  string $route
     * @param  array  $params
     * @return string
     */
    public function getUrl(string $route = '', array $params = []): string
    {
        return $this->url->getUrl($route, $params);
    }
}
