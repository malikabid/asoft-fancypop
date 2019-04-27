<?php

namespace Asoft\Fancypop\Helper;

use Asoft\Fancypop\Model\Config\Source\PageTypes;

class Data extends \Magento\Framework\App\Helper\AbstractHelper
{

    /**
     * TimeZoneInterface
     *
     * @var \Magento\Framework\Stdlib\DateTime\TimezoneInterface
     */
    protected $_timezoneInterface;


    /**
     * CategoryRepository
     *
     * @var \Magento\Catalog\Model\CategoryRepository
     */
    protected $_categoryRepository;


    /**
     * class constructor
     *
     * @param \Magento\Framework\App\Helper\Context $context
     * @param \Magento\Store\Model\StoreManagerInterface $storeManager
     * @param \Magento\Framework\Stdlib\DateTime\TimezoneInterface $timezoneInterface
     * @param \Magento\Catalog\Model\CategoryRepository $categoryRepository
     */
    public function __construct(
        \Magento\Framework\App\Helper\Context $context,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Magento\Framework\Stdlib\DateTime\TimezoneInterface $timezoneInterface,
        \Magento\Catalog\Model\CategoryRepository $categoryRepository

        ) {
        $this->_storeManager = $storeManager;
        $this->_timezoneInterface = $timezoneInterface;
        $this->_categoryRepository = $categoryRepository;
        parent::__construct($context);
    }

    /**
     * get module configuration 
     *
     * @param string $config_path
     * @return mixed
     */         
    public function getConfig($config_path)
    {
        return $this->scopeConfig->getValue(
            $config_path,
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );
    }

    /**
     * getBaseUrl of images - store scope
     *
     * @return mixed
     */         
    public function getBaseUrl()
    {
        return $this->_storeManager->getStore()->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA);
    }


    /**
     * check if today is in range of two dates
     *
     * @return boolean
     */
    public function isTodayInRange(){

        $popup_active_from = $this->getConfig('fancypopup/popup/active_from');
        $popup_active_to = $this->getConfig('fancypopup/popup/active_to');

        return $this->_timezoneInterface->isScopeDateInInterval(
            $this->_storeManager->getStore()->getStoreId(),
            $popup_active_from,
            $popup_active_to
        );
    }


    /**
     * Get URL of the page to be linked
     *
     * @return mixed
     */
    public function getLinkPageUrl(){

        $link_page_url = '';

        $page_type = $this->getConfig('fancypopup/popup/link_to_page_type');

        switch($page_type){
            case PageTypes::PAGE_TYPE_CMS:
                $page = $this->getConfig('fancypopup/popup/link_to_cms_page');
                $link_page_url = $this->_storeManager->getStore()->getBaseUrl().$page;
                break;
            case PageTypes::PAGE_TYPE_CATEGORY:
                //TODO::Impelemyent logic here
                $categoryId = $this->getConfig('fancypopup/popup/link_to_category');
                $category = $this->_categoryRepository->get($categoryId, $this->_storeManager->getStore()->getId());
                $link_page_url = $category->getUrl();
                break;
            case PageTypes::PAGE_TYPE_OTHER:
                $page = $this->getConfig('fancypopup/popup/link_to_other_page');
                $link_page_url = $this->_storeManager->getStore()->getBaseUrl().$page;
                break;
            default:
                $link_page_url = '';
            
        }

        return $link_page_url;
    }
}