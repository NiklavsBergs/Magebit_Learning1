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

namespace Magebit\Faq\Block\Adminhtml\Question\Edit;

use Magento\Framework\UrlInterface;

abstract class Generic
{
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
