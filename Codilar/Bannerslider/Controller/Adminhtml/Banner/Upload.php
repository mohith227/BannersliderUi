<?php
/**
 * Created by PhpStorm.
 * User: mohith
 * Date: 20/9/18
 * Time: 1:19 PM
 */
namespace Codilar\Bannerslider\Controller\Adminhtml\Banner;

use Magento\Framework\Controller\ResultFactory;

/**
 * Class Upload
 */
//class Upload extends \Magento\Backend\App\Action
//{
//
//    protected $imageUploader;
//
//    /**
//     * @param \Magento\Backend\App\Action\Context $context
//     * @param \Magento\Catalog\Model\ImageUploader $imageUploader
//     */
//    public function __construct(
//        \Magento\Backend\App\Action\Context $context,
//        \Magento\Catalog\Model\ImageUploader $imageUploader
//    ) {
//        parent::__construct($context);
//        $this->imageUploader = $imageUploader;
//    }
//
//    /**
//     * Check admin permissions for this controller
//     *
//     * @return boolean
//     */
//    protected function _isAllowed()
//    {
//        return $this->_authorization->isAllowed('Codilar_Bannerslider::Banner');
//    }
//
//    /**
//     * Upload file controller action
//     *
//     * @return \Magento\Framework\Controller\ResultInterface
//     */
//    public function execute()
//    {
//     
//        try {
//            $result = $this->imageUploader->saveFileToTmpDir('banner[image]');
//            if ($result) {
//                $uploadedFileName = $result['name'];
//                // save the file name in db here
//            }
//            $result['cookie'] = [
//                'name' => $this->_getSession()->getName(),
//                'value' => $this->_getSession()->getSessionId(),
//                'lifetime' => $this->_getSession()->getCookieLifetime(),
//                'path' => $this->_getSession()->getCookiePath(),
//                'domain' => $this->_getSession()->getCookieDomain(),
//            ];
//        } catch (\Exception $e) {
//            $result = ['error' => $e->getMessage(), 'errorcode' => $e->getCode()];
//        }
//        return $this->resultFactory->create(ResultFactory::TYPE_JSON)->setData($result);
//    }
//}
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Codilar\Bannerslider\Model\Uploader;

class Upload extends Action
{
    /**
     * @var string
     */
    const ACTION_RESOURCE = 'Codilar_Bannerslider::image';

    /**
     * @var Uploader
     */
    protected $uploader;

    /**
     * Upload constructor.
     *
     * @param Context $context
     * @param Uploader $uploader
     */
    public function __construct(
        Context $context,
        Uploader $uploader
    ) {
        parent::__construct($context);
        $this->uploader = $uploader;
    }

    /**
     * Upload file controller action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        try {
            $result = $this->uploader->saveFileToTmpDir($this->getFieldName());

            $result['cookie'] = [
                'name' => $this->_getSession()->getName(),
                'value' => $this->_getSession()->getSessionId(),
                'lifetime' => $this->_getSession()->getCookieLifetime(),
                'path' => $this->_getSession()->getCookiePath(),
                'domain' => $this->_getSession()->getCookieDomain(),
            ];
        } catch (\Exception $e) {
            $result = ['error' => $e->getMessage(), 'errorcode' => $e->getCode()];
        }
        return $this->resultFactory->create(ResultFactory::TYPE_JSON)->setData($result);
    }

    /**
     * @return string
     */
    protected function getFieldName()
    {
        return $this->_request->getParam('field');
    }
}


