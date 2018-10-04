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

namespace Codilar\Bannerslider\Controller\Adminhtml\Slider;

use Magento\Framework\Controller\ResultFactory;
/**
 * MassDelete action.
 * @category Codilar
 * @package  Codilar_Bannerslider
 * @module   Bannerslider
 * @author   Codilar Developer
 */
class MassDelete extends \Codilar\Bannerslider\Controller\Adminhtml\AbstractAction
{

    public function execute()
    {
        $sliderIds = $this->getRequest()->getParam('slider');
        if (!is_array($sliderIds) || empty($sliderIds)) {
            $this->messageManager->addErrorMessage(__('Please select slider(s).'));
        } else {
            try {
                foreach ($sliderIds as $sliderUd) {
                    $slider = $this->_objectManager->create('Codilar\Bannerslider\Model\Slider')
                        ->load($sliderUd);
                    $slider->delete();
                }
                $this->messageManager->addSuccessMessage(
                    __('A total of %1 record(s) have been deleted.', count($sliderIds))
                );
            } catch (\Exception $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
            }
        }
        $resultRedirect = $this->resultRedirectFactory->create();
        return $resultRedirect->setPath('*/*/');
    }
}
