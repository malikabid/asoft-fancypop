<?php

namespace Asoft\Fancypop\Model\Config\Source;

use Magento\Framework\Option\ArrayInterface;

/**
 * @testFunction testCategoryList
 */
class CategoryList implements ArrayInterface
{

    /**
     * CategoryFactory
     *
     * @var \Magento\Catalog\Model\CategoryFactory
     */
    protected $_categoryFactory;

    /**
     * CategoryCollectionFactory
     *
     * @var \Magento\Catalog\Model\ResourceModel\Category\CollectionFactory
     */
    protected $_categoryCollectionFactory;


    /**
     * constructor
     *
     * @param \Magento\Catalog\Model\CategoryFactory $categoryFactory
     * @param \Magento\Catalog\Model\ResourceModel\Category\CollectionFactory $categoryCollectionFactory
     */
    public function __construct(
        \Magento\Catalog\Model\CategoryFactory $categoryFactory,
        \Magento\Catalog\Model\ResourceModel\Category\CollectionFactory $categoryCollectionFactory
    ) {
        $this->_categoryFactory = $categoryFactory;
        $this->_categoryCollectionFactory = $categoryCollectionFactory;
    }


    /**
     * get the category collection
     *
     * @param boolean $isActive
     * @param boolean $level
     * @param boolean $sortBy
     * @param boolean $pageSize
     * @return CollectionFactory $collection
     * @testFunction testCategoryListGetCategoryCollection
     */
    public function getCategoryCollection($isActive = true, $level = false, $sortBy = false, $pageSize = false)
    {
        $collection = $this->_categoryCollectionFactory->create();
        $collection->addAttributeToSelect('*');

        // select only active categories
        if ($isActive) {
            $collection->addIsActiveFilter();
        }

        // select categories of certain level
        if ($level) {
            $collection->addLevelFilter($level);
        }

        // sort categories
        if ($sortBy) {
            $collection->addOrderField($sortBy);
        }

        // select certain number of categories
        if ($pageSize) {
            $collection->setPageSize($pageSize);
        }

        return $collection;
    }


    /**
     * toOptionArray
     *
     * @return array($mixed)
     * @testFunction testCategoryListToOptionArray
     */
    public function toOptionArray()
    {
        $arr = $this->_toArray();
        $ret = [];

        foreach ($arr as $key => $value) {
            $ret[] = [
                'value' => $key,
                'label' => $value
            ];
        }

        return $ret;
    }


    /**
     * _toArray
     *
     * @return array($categories)
     */
    private function _toArray()
    {
        $categories = $this->getCategoryCollection(true, false, false, false);
        $categoryList = array();

        foreach ($categories as $category) {
            $categoryList[$category->getEntityId()] = $this->_getParentName($category->getPath()) . $category->getName();
        }

        return $categoryList;
    }


    /**
     * appends parent category name with category
     *
     * @param string $path
     * @return string $parentName
     */
    private function _getParentName($path = '')
    {
        $parentName = '';
        $rootCategories = [1,2];

        $categoryTree = explode("/", $path);

        //delete the category itself
        array_pop($categoryTree);

        if($categoryTree && (count($categoryTree) > count($rootCategories))){
            foreach($categoryTree as $categoryId){
                if(!in_array($categoryId,$rootCategories)){
                    $category =  $this->_categoryFactory->create()->load($categoryId);
                    $categoryName = $category->getName();

                    $parentName .= $categoryName .' -> ';
                }
            }
        }

        return $parentName;

    }
}
