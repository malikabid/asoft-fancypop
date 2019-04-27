<?php

namespace Asoft\Fancypop\Model\Config\Backend\Image;

use Magento\Config\Model\Config\Backend\Image;

class Popupbg extends Image
{
    /**
     * Image upload directory
     */
    const UPLOAD_DIR = 'asoft/fancypop/background';

    
    /**
     * _getUploadDir
     *
     * @return mixed
     */
    protected function _getUploadDir()
    {
        return $this->_mediaDirectory->getAbsolutePath($this->_appendScopeInfo(self::UPLOAD_DIR));
    }

    /**
     * _addWhetherScopeInfo
     *
     * @return boolean
     */
    protected function _addWhetherScopeInfo()
    {
        return true;
    }

    /**
     * _getAllowedExtensions
     *
     * @return array(mixed)
     */
    protected function _getAllowedExtensions()
    {
        return['jpg','jpeg','gif','png','svg'];
    }
}