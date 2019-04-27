<?php

namespace Asoft\Fancypop\Block\System\Config\Form\Field;

use Magento\Config\Block\System\Config\Form\Field;

class Color extends Field
{
    /**
     * Core Registry
     *
     * @var \Magento\Framework\Registry
     */
    protected $_coreRegistry;

    
    /**
     * __construct
     *
     * @return void
     */
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Framework\Registry $coreRegistry,
        array $data = []
    )
    {
        $this->_coreRegistry = $coreRegistry;
        parent::__construct($context);
    }
    

    
    /**
     * _getElementHtml
     *
     * @param \Magento\Framework\Data\Form\Element\AbstractElement $element
     * @return mixed
     */
    public function _getElementHtml(\Magento\Framework\Data\Form\Element\AbstractElement $element){
        $html = $element->getElementHtml();
        $value = $element->getData('value');
 
        $html .= '<script type="text/javascript">
            require(["jquery","jquery/colorpicker/js/colorpicker"], function ($) {
                $(document).ready(function () {
                    var $el = $("#'.$element->getHtmlId().'");
                    $el.css("backgroundColor", "'.$value.'");
 
                    // Attach the color picker
                    $el.ColorPicker({
                        color: "'.$value.'",
                        onChange: function (hsb, hex, rgb) {
                            $el.css("backgroundColor", "#" + hex).val("#" + hex);
                        }
                    });
                });
            });
            </script>';
 
        return $html;
    }
}