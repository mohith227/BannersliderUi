<?php
namespace Codilar\Bannerslider\Controller\Adminhtml\Banner;

use Codilar\Bannerslider\Helper\Data as BannerHelper;
use Magento\Backend\App\Action;
use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Filesystem;
use Magento\Framework\Image\AdapterFactory;
use Magento\MediaStorage\Model\File\UploaderFactory;
use Magento\Framework\App\Request\Http;
use Codilar\Bannerslider\Model\Banner;
use Codilar\Bannerslider\Model\Uploader;
use Codilar\Bannerslider\Model\UploaderPool;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Api\DataObjectHelper;
use Magento\Framework\Message\Manager;
use Magento\Framework\Registry;
use Magento\Framework\Stdlib\DateTime\Filter\Date;
use Magento\Framework\View\Result\PageFactory;

/**
 * Class Save
 * @package Codilar\Bannerslider\Controller\Adminhtml\Banner
 */
class Save extends \Magento\Backend\App\Action
{
    const PARAM_CRUD_ID = 'entity_id';

    /**
     * @var \Magento\Backend\Helper\Js
     */
    protected $_jsHelper;

    /**
     * @var \Magento\Store\Model\StoreManagerInterface
     */
    protected $_storeManager;

    /**
     * @var \Magento\Backend\Model\View\Result\ForwardFactory
     */
    protected $_resultForwardFactory;

    /**
     * @var \Magento\Framework\View\Result\LayoutFactory
     */
    protected $_resultLayoutFactory;

    /**
     * A factory that knows how to create a "page" result
     * Requires an instance of controller action in order to impose page type,
     * which is by convention is determined from the controller action class.
     *
     * @var \Magento\Framework\View\Result\PageFactory
     */
    protected $_resultPageFactory;

    /**
     * Banner factory.
     *
     * @var \Codilar\Bannerslider\Model\BannerFactory
     */
    protected $_bannerFactory;

    /**
     * Slider factory.
     *
     * @var \Codilar\Bannerslider\Model\SliderFactory
     */
    protected $_sliderFactory;

    /**
     * Banner Collection Factory.
     *
     * @var \Codilar\Bannerslider\Model\ResourceModel\Banner\CollectionFactory
     */
    protected $_bannerCollectionFactory;

    /**
     * Registry object.
     *
     * @var \Magento\Framework\Registry
     */
    protected $_coreRegistry;

    /**
     * File Factory.
     *
     * @var \Magento\Framework\App\Response\Http\FileFactory
     */
    protected $_fileFactory;

    /**
     * @var \Magento\Ui\Component\MassAction\Filter
     */
    protected $_massActionFilter;

    /**
     * @var \Magento\MediaStorage\Model\File\UploaderFactory
     */
    protected $_uploaderFactory;

    /**
     * @var \Magento\Framework\Image\AdapterFactory
     */
    protected $_adapterFactory;

    /**
     * @var \Magento\Framework\Filesystem
     */
    protected $_filesystem;
    /**
     * @var DataPersistorInterface
     */
    protected  $_dataPersistor;
    /**
     * @var Http
     */
    protected  $_http;

    protected $bannerHelper;
    
    protected $uploaderPool;

    /**
     * Save constructor.
     * @param Action\Context $context
     * @param \Codilar\Bannerslider\Model\BannerFactory $bannerFactory
     * @param \Codilar\Bannerslider\Model\SliderFactory $sliderFactory
     * @param \Codilar\Bannerslider\Model\ResourceModel\Banner\CollectionFactory $bannerCollectionFactory
     * @param \Codilar\Bannerslider\Model\ResourceModel\Slider\CollectionFactory $sliderCollectionFactory
     * @param Filesystem $filesystem
     * @param \Magento\Framework\Registry $coreRegistry
     * @param \Magento\Framework\App\Response\Http\FileFactory $fileFactory
     * @param \Magento\Framework\View\Result\PageFactory $resultPageFactory
     * @param \Magento\Framework\View\Result\LayoutFactory $resultLayoutFactory
     * @param \Magento\Backend\Model\View\Result\ForwardFactory $resultForwardFactory
     * @param \Magento\Store\Model\StoreManagerInterface $storeManager
     * @param \Magento\Backend\Helper\Js $jsHelper
     * @param \Magento\Ui\Component\MassAction\Filter $massActionFilter
     * @param UploaderFactory $uploaderFactory
     * @param AdapterFactory $adapterFactory
     * @param DataPersistorInterface $dataPersistor
     * @param Http $http
     * @param BannerHelper $bannerHelper
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Codilar\Bannerslider\Model\BannerFactory $bannerFactory,
        \Codilar\Bannerslider\Model\SliderFactory $sliderFactory,
        \Codilar\Bannerslider\Model\ResourceModel\Banner\CollectionFactory $bannerCollectionFactory,
        \Codilar\Bannerslider\Model\ResourceModel\Slider\CollectionFactory $sliderCollectionFactory,
        \Magento\Framework\Filesystem $filesystem,
        \Magento\Framework\Registry $coreRegistry,
        \Magento\Framework\App\Response\Http\FileFactory $fileFactory,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        \Magento\Framework\View\Result\LayoutFactory $resultLayoutFactory,
        \Magento\Backend\Model\View\Result\ForwardFactory $resultForwardFactory,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Magento\Backend\Helper\Js $jsHelper,
        \Magento\Ui\Component\MassAction\Filter $massActionFilter,
        \Magento\MediaStorage\Model\File\UploaderFactory $uploaderFactory,
        \Magento\Framework\Image\AdapterFactory $adapterFactory,
        \Magento\Framework\App\Request\DataPersistorInterface $dataPersistor,
        \Magento\Framework\App\Request\Http $http,
        UploaderPool $uploaderPool,
        BannerHelper $bannerHelper
    ) {
        parent::__construct($context);
        $this->_coreRegistry = $coreRegistry;
        $this->_fileFactory = $fileFactory;
        $this->_storeManager = $storeManager;
        $this->_jsHelper = $jsHelper;
        $this->_massActionFilter = $massActionFilter;

        $this->_resultPageFactory = $resultPageFactory;
        $this->_resultLayoutFactory = $resultLayoutFactory;
        $this->_resultForwardFactory = $resultForwardFactory;

        $this->_bannerFactory = $bannerFactory;
        $this->_sliderFactory = $sliderFactory;
        $this->_bannerCollectionFactory = $bannerCollectionFactory;
        $this->_sliderCollectionFactory = $sliderCollectionFactory;
        $this->_uploaderFactory = $uploaderFactory;
        $this->_adapterFactory = $adapterFactory;
        $this->_filesystem = $filesystem->getDirectoryWrite(\Magento\Framework\App\Filesystem\DirectoryList::MEDIA);
        $this->_dataPersistor = $dataPersistor;
        $this->_http = $http;
        $this->bannerHelper = $bannerHelper;
        $this->uploaderPool = $uploaderPool;
    }
    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    public function execute()
    {
        $resultRedirect = $this->resultRedirectFactory->create();

//        if ($data = $this->getRequest()->getPostValue()) {
//            $model = $this->_bannerFactory->create();
//            $storeViewId = $this->getRequest()->getParam('store');
//
//            if ($id = $this->getRequest()->getParam(static::PARAM_CRUD_ID)) {
//                $model->load($id);
//            }
//
//            $imageRequest = $this->getRequest()->getFiles('banner[image]')['0'];
////            echo"<pre>";
////            var_dump($data);
////            echo"<pre>";
////            var_dump( $imageRequest['name']);die;
//            if ($imageRequest) {
//                if (isset($imageRequest['name'])) {
//                    $fileName = $imageRequest['name'];
//                } else {
//                    $fileName = '';
//                }
//            } else {
//                $fileName = '';
//            }
//
//            if ($imageRequest && strlen($fileName)) {
//                /*
//                 * Save image upload
//                 */
//                try {
//                    $uploader = $this->_uploaderFactory->create(['fileId' => 'image']);
//                    $uploader->setAllowedExtensions(['jpg', 'jpeg', 'gif', 'png']);
//
//                    /** @var \Magento\Framework\Image\Adapter\AdapterInterface $imageAdapter */
//                    $imageAdapter = $this->_adapterFactory->create();
//
//                    $uploader->addValidateCallback('banner_image', $imageAdapter, 'validateUploadFile');
//                    $uploader->setAllowRenameFiles(true);
//                    $uploader->setFilesDispersion(true);
//
//                    /** @var \Magento\Framework\Filesystem\Directory\Read $mediaDirectory */
//                    $mediaDirectory = $this->_objectManager->get('Magento\Framework\Filesystem')
//                        ->getDirectoryRead(DirectoryList::MEDIA);
//                    $result = $uploader->save(
//                        $mediaDirectory->getAbsolutePath(\Codilar\Bannerslider\Model\Banner::BASE_MEDIA_PATH)
//                    );
//                    $data['banner']['image'] = \Codilar\Bannerslider\Model\Banner::BASE_MEDIA_PATH.$result['file'];
//                } catch (\Exception $e) {
//                    if ($e->getCode() == 0) {
//                        $this->messageManager->addError($e->getMessage());
//                    }
//                }
//            } else {
//                if (isset($data['banner']['image']) && isset($data['banner']['image']['value'])) {
//                    if (isset($data['banner']['image']['delete'])) {
//                        $data['banner']['image'] = null;
//                        $data['banner']['delete_image'] = true;
//                    } elseif (isset($data['banner']['image']['value'])) {
//                        $data['banner']['image'] = $data['banner']['image']['value'];
//                    } else {
//                        $data['banner']['image'] = null;
//                    }
//                }
//            }

//            try {
//                $data['banner']['image'] = $this->uploadImageAndGetUrl('image', Banner::BASE_MEDIA_PATH);
//            } catch (\Exception $e) {
//                $this->messageManager->addException($e, __('Image not uploaded'));
//            }
            /** @var \Magento\Framework\Stdlib\DateTime\TimezoneInterface $localeDate */
            $localeDate = $this->_objectManager->get('Magento\Framework\Stdlib\DateTime\TimezoneInterface');
//
//            try {
//                $data['banner']['image'] = $this->uploadImageAndGetUrl('image', \Codilar\Bannerslider\Model\Banner::BASE_MEDIA_PATH);
//            } catch (\Exception $e) {
//                if (!$data['banner']) {
//                    $this->messageManager->addErrorMessage($e->getMessage());
//                    return $resultRedirect->setPath(
//                        '*/*/edit',
//                        [static::PARAM_CRUD_ID => $this->getRequest()->getParam(static::PARAM_CRUD_ID)]
//                    );                }
//            }


        $data = $this->getRequest()->getPostValue();
//        echo"<pre>";
//        var_dump($data);die;

        $resultRedirect = $this->resultRedirectFactory->create();
            try {
                $image = $this->getUploader('image')->uploadFileAndGetName('image', $data);
                $data['image'] = $image;
                return $resultRedirect->setPath('*/*/');
            } catch (\Magento\Framework\Exception\LocalizedException $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
            } catch (\RuntimeException $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addException(
                    $e,
                    __('Something went wrong while saving the image:' . $e->getMessage())
                );
            }

            $this->_getSession()->setFormData($data);
            return $resultRedirect->setPath('*/*/edit', ['image_id' => $this->getRequest()->getParam('image_id')]);
            $localeDate = $this->_objectManager->get('Magento\Framework\Stdlib\DateTime\Timezone');
            $data['start_time'] = $localeDate->date($data['banner']['start_time'], null, 'UTC')->format('Y-m-d H:i');
            $data['end_time'] = $localeDate->date($data['banner']['end_time'],  null, 'UTC')->format('Y-m-d H:i');
            $model->setData($data['banner'])
                ->setStoreViewId($storeViewId);
            try {
                $model->save();
                $this->messageManager->addSuccess(__('The banner has been saved.'));
                return $resultRedirect->setPath('*/*/save');
            } catch (\Exception $e) {
                $this->messageManager->addException($e, __('Something went wrong while saving the banner'));
            }

            $this->_getSession()->setFormData($data);

            return $resultRedirect->setPath(
                '*/*/edit',
                [static::PARAM_CRUD_ID => $this->getRequest()->getParam(static::PARAM_CRUD_ID)]
            );
        }
//    protected function uploadImageAndGetUrl($imageId, $base_media_path)
//    {
//        try {
//            $uploader = $this->_uploader->create(
//                ['fileId' => $imageId]
//            );
//            $uploader->setAllowedExtensions(['jpg', 'jpeg', 'gif', 'png']);
//            $imageAdapter = $this->_adapterFactory->create();
//            $uploader->addValidateCallback('image', $imageAdapter, 'validateUploadFile');
//            $uploader->setAllowRenameFiles(true);
//            $uploader->setFilesDispersion(true);
//            $mediaDirectory = $this->_filesystem->getDirectoryRead(\Magento\Framework\App\Filesystem\DirectoryList::MEDIA);
//            $result = $uploader->save(
//                $mediaDirectory->getAbsolutePath($base_media_path)
//            );
//            $firstChar = substr($result['file'], 0, 1);
//            if ($firstChar == "/") {
//                return $base_media_path . $result['file'];
//            } else {
//                return $base_media_path . '/' . $result['file'];
//            }
//
//        } catch (\Exception $e) {
//            throw new \Exception("Some error occured while uploading image");
//        }
//    }
//
//    /**
//     * @return bool
//     */
//    protected function _isAllowed()
//    {
//        return $this->_authorization->isAllowed("Codilar_BannerSlider::bannerslider_save");
//    }
    protected function getUploader($type)
    {
        return $this->uploaderPool->getUploader($type);
    }

}
