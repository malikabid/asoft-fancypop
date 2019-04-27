<?php

namespace Asoft\Fancypop\Block\Adminhtml\System\Config;

use Magento\Config\Block\System\Config\Form\Field;

class Date extends Field
{
    /**
     * render
     *
     * @param  mixed $element
     *
     * @return void
     */
    public function render(\Magento\Framework\Data\Form\Element\AbstractElement $element)
    {
        $element->setDateFormat(\Magento\Framework\Stdlib\DateTime::DATE_INTERNAL_FORMAT);
        $element->setTimeFormat(null);
        return parent::render($element);
    }
}