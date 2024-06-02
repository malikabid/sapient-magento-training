<?php

namespace Asoft\Blog\Model\Source;

class Enabled implements \Magento\Framework\Data\OptionSourceInterface
{
    public function toOptionArray()
    {
        return [
            [
                'label' => __('No'),
                'value' => 0
            ],
            [
                'label' => __('Yes'),
                'value' => 1
            ]
        ];
    }
}
