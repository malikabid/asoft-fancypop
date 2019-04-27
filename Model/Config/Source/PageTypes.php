<?php

namespace Asoft\Fancypop\Model\Config\Source;

use Magento\Framework\Option\ArrayInterface;

class PageTypes implements ArrayInterface
{

    /**
     * Page Type Constants
     */
    const PAGE_TYPE_NONE = 0;
    const PAGE_TYPE_CMS = 1;
    const PAGE_TYPE_CATEGORY = 2;
    const PAGE_TYPE_OTHER = -1;


    /**
     * toOptionArray
     *
     * @return array
     */
    public function toOptionArray()
    {
        return [
            ['value' => self::PAGE_TYPE_NONE, 'label' => __('None')],
            ['value' => self::PAGE_TYPE_CMS, 'label' => __('CMS Page')], 
            ['value' => self::PAGE_TYPE_CATEGORY, 'label' => __('Category')],
            ['value' => self::PAGE_TYPE_OTHER, 'label' => __('Other')]
        ];
    }

    /**
     * toArray
     *
     * @return array
     */
    public function toArray(){
        return [
                    self::PAGE_TYPE_NONE => __('None'),
                    self::PAGE_TYPE_CMS => __('CMS Page'), 
                    self::PAGE_TYPE_CATEGORY => __('Category'),
                    self::PAGE_TYPE_OTHER => __('Other')
                ];
    }

    public function getMessage(){
        return 'Hello Magento 2! We will change the world!';
    }
}