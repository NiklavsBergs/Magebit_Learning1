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

namespace Magebit\Faq\ViewModel;

use Magebit\Faq\Model\ResourceModel\Question\Collection;
use Magebit\Faq\Service\QuestionProvider;
use Magento\Framework\View\Element\Block\ArgumentInterface;

class Questions implements ArgumentInterface
{

    /**
     * @param QuestionProvider $questionProvider
     */
    public function __construct(private QuestionProvider $questionProvider)
    {}
    public function getQuestions()
    {
        return $this->questionProvider->getQuestions();
    }
}
