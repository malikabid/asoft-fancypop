<?php

namespace Asoft\Fancypop\Model\Config\Settings\Popup;

use Magento\Framework\Option\ArrayInterface;

class ShowOn implements ArrayInterface
{
    /**
     * toOptionArray
     *
     * @return array($mixed)
     */
    public function toOptionArray()
    {
        return [
            ['value' => '1', 'label' => __('Homepage Only')], 
            ['value' => '2', 'label' => __('All Pages')]
        ];
    }

    /**
     * toArray
     *
     * @return array($mixed)
     */
    public function toArray(){
        return [
                    '1' => __('Enable on Only Homepage'), 
                    '2' => __('Enable on All Pages')
                ];
    }
}