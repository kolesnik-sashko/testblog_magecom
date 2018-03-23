<?php

namespace Magecom\DFS\Model\System\Source;

use Magento\SalesRule\Api\Data\RuleInterface;
use Magento\Framework\Option\ArrayInterface;

class SimpleAction implements ArrayInterface
{
    
    public function toOptionArray()
    {
        return [
            ['value' => RuleInterface::DISCOUNT_ACTION_BY_PERCENT, 'label' => 'Percent of product price discount'],
            ['value' => RuleInterface::DISCOUNT_ACTION_FIXED_AMOUNT, 'label' => 'Fixed amount discount']
        ];
    }
}