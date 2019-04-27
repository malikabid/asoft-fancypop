<?php

namespace Asoft\Fancypop\Test\Unit\Model\Config\Source;

class PageTypesTest extends \PHPUnit_Framework_TestCase
{
    protected $helloMessage;
    protected $expectedArray;
    
    /**
     * Is called before running a test
     */
    protected function setUp()
    {
        $objectManager = new \Magento\Framework\TestFramework\Unit\Helper\ObjectManager($this);
        $this->helloMessage = $objectManager->getObject('Asoft\Fancypop\Model\Config\Source\PageTypes');
        // $this->expectedMessage = 'Hello Magento 2! We will change the world!';
        $this->expectedArray  =  [
            ['value' => 0, 'label' => __('None')],
            ['value' => 1, 'label' => __('CMS Page')], 
            ['value' => 2, 'label' => __('Category')],
            ['value' => -1, 'label' => __('Other')]
        ];
        
    }

   
    /**
     * The test itself, every test function must start with 'test'
     */
    public function testToOptionArray()
    {
        $this->assertEquals($this->expectedArray,$this->helloMessage->toOptionArray());
    }

    // public function testGetMessage()
    // {
    //      $this->assertEquals($this->expectedMessage, $this->helloMessage->getMessage());
    // }
}