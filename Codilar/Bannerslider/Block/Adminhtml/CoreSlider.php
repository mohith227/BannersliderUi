<?php

/**
 * Codilar
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Codilar.com license that is
 * available through the world-wide-web at this URL:
 * http://www.Codilar.com/license-agreement.html
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade this extension to newer
 * version in the future.
 *
 * @category    Codilar
 * @package     Codilar_Bannerslider
 * @copyright   Copyright (c) 2012 Codilar (http://www.Codilar.com/)
 * @license     http://www.Codilar.com/license-agreement.html
 */

namespace Codilar\Bannerslider\Block\Adminhtml;

/**
 * core slider grid container.
 * @category Codilar
 * @package  Codilar_Bannerslider
 * @module   Bannerslider
 * @author   Codilar Developer
 */
class CoreSlider extends \Magento\Backend\Block\Widget\Grid\Container
{
    /**
     * Constructor.
     */
    protected function _construct()
    {
        $this->_controller = 'adminhtml_coreSlider';
        $this->_blockGroup = 'Codilar_Bannerslider';
        $this->_headerText = __('Preview Slider Styles');
        $this->_addButtonLabel = __('Add New Slider');
        parent::_construct();
        $this->removeButton('add');
    }
}
