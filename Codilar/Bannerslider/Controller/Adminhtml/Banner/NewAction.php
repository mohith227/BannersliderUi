<?php
namespace Codilar\Bannerslider\Controller\Adminhtml\Banner;

/**
 * NewAction
 * @category Codilar
 * @package  Codilar_Bannerslider
 * @module   Bannerslider
 * @author   Codilar Developer
 */
use Codilar\Bannerslider\Model\Banner as Banner;
class NewAction extends \Codilar\Bannerslider\Controller\Adminhtml\Banner
{
    public function execute()
    {
        print_r($this->getRequest()->getParam('banner'));
        $resultForward = $this->_resultForwardFactory->create();
        return $resultForward->forward('edit');
//        $this->_view->loadLayout();
//        $this->_view->renderLayout();
//
//        $bannerDatas = $this->getRequest()->getParam('banner');
//        if($bannerDatas)
//        {
//            $resultRedirect = $this->resultRedirectFactory->create();
//            return $resultRedirect->setPath('*/*/save');
//        }
//        
//        if(is_array($bannerDatas)) {
//            $banner = $this->_objectManager->create(Banner::class);
//            $banner->setData($bannerDatas)->save();
//            $resultRedirect = $this->resultRedirectFactory->create();
//            return $resultRedirect->setPath('*/*/index');
//        }
    }
}
