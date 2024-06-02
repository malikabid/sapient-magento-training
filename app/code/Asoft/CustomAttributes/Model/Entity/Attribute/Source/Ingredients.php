<?php

namespace Asoft\CustomAttributes\Model\Entity\Attribute\Source;

use Magento\Eav\Model\Entity\Attribute\Source\AbstractSource;

class Ingredients extends AbstractSource
{
    public function getAllOptions()
    {
        return [
            [
                'label' => __('Salt'),
                'value' => 'salt'
            ],
            [
                'label' => __('Sweetner'),
                'value' => 'sugar'
            ],
            [
                'label' => __('Tomato'),
                'value' => 'tomato'
            ],
            [
                'label' => __('Green Chillies'),
                'value' => 'green_chillies'
            ]
        ];
    }
}
