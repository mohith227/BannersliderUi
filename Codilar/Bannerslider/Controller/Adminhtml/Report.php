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

namespace Codilar\Bannerslider\Controller\Adminhtml;

/**
 * Report Abstract Action
 * @category Codilar
 * @package  Codilar_Bannerslider
 * @module   Bannerslider
 * @author   Codilar Developer
 */
abstract class Report extends \Codilar\Bannerslider\Controller\Adminhtml\AbstractAction
{
    /**
     * Check if admin has permissions to visit related pages.
     *
     * @return bool
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Codilar_Bannerslider::bannerslider_reports');
    }
}
