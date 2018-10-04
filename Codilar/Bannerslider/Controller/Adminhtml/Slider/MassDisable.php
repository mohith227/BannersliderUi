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
use Codilar\Bannerslider\Model\ResourceModel\Banner\Grid\StatusesArray;
/**
 * MassDelete action.
 * @category Codilar
 * @package  Codilar_Bannerslider
 * @module   Bannerslider
 * @author   Codilar Developer
 */
class MassDisable extends \Codilar\Bannerslider\Controller\Adminhtml\AbstractAction
{

    /**
     * Execute action
     *
     * @return \Magento\Backend\Model\View\Result\Redirect
     * @throws \Magento\Framework\Exception\LocalizedException|\Exception
     */
    public function execute()
    {
        $sliderCollection = $this->_objectManager->create('Codilar\Bannerslider\Model\ResourceModel\Slider\Collection');
        $collection = $this->_massActionFilter->getCollection($sliderCollection);
        $collectionSize = $collection->getSize();
        foreach ($collection as $item) {
            $item->setStatus(StatusesArray::STATUS_DISABLED);
            try{
                $item->save();

            }catch (\Exception $e){
                $this->messageManager->addError($e->getMessage());
            }
        }

        $this->messageManager->addSuccess(__('A total of %1 record(s) have been disabled.', $collectionSize));

        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);

        return $resultRedirect->setPath('*/*/');
    }
}
