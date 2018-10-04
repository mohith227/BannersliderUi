<?php
/**
 * Created by PhpStorm.
 * User: mohith
 * Date: 1/10/18
 * Time: 6:42 AM
 */
namespace Codilar\Bannerslider\Block\Adminhtml\Banner\Edit;

use Codilar\BannerSlider\Model\Banner;
use Magento\Backend\Block\Template\Context;
use Magento\Framework\Filesystem;
use Magento\Framework\Filesystem\DirectoryList;
use Magento\Framework\Filesystem\Driver\File;
use Magento\Store\Model\StoreManagerInterface;

/**
 * Class DesktopBannerRenderer
 * @package Codilar\BannerSlider\Block\Adminhtml\Banner\Edit
 */
class ImageRenderer extends \Magento\Backend\Block\Template
{
    /**
     * Block template.
     *
     * @var string
     */
    protected $_template = 'banner/image.phtml';
    /**
     * @var Filesystem\Directory\WriteInterface
     */
    protected $_mediaDirectory;
    /**
     * @var StoreManagerInterface
     */
    private $storeManager;
    /**
     * @var File
     */
    private $file;
    /**
     * @var Banner
     */
    private $bannerSlider;
    /**
     * @var DirectoryList
     */
    private $directoryList;


    /**
     * DesktopBannerRenderer constructor.
     * @param Context               $context
     * @param Filesystem            $filesystem
     * @param StoreManagerInterface $storeManager
     * @param File                  $file
     * @param Banner         $bannerSlider
     * @param DirectoryList         $directoryList
     * @param array                 $data
     */
    public function __construct(
        Context $context,
        Filesystem $filesystem,
        StoreManagerInterface $storeManager,
        File $file,
        Banner $banner,
        DirectoryList $directoryList,
        array $data = []
    )
    {
        parent::__construct($context, $data);
        $this->_mediaDirectory = $filesystem->getDirectoryRead(\Magento\Framework\App\Filesystem\DirectoryList::MEDIA);
        $this->storeManager = $storeManager;
        $this->file = $file;
        $this->bannerSlider = $banner;
        $this->directoryList = $directoryList;
    }

    /**
     * @return string
     */
    public function getDesktopBannerImagePath()
    {
        $params = $this->getRequest()->getParams();
        $mediaUrl = $this->storeManager->getStore()->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA);
        $bannerId = $params['banner_id'];
        $banner = $this->bannerSlider->getBannerById($bannerId);
        if ($banner->getData()) {
            $imagePath = $banner->getBanner();
            $lastChar = substr($mediaUrl, -1);
            if ($lastChar == "/") {
                $mediaUrl = substr($mediaUrl, 0, strlen($mediaUrl) - 1);
            }
            $absoluteImagePath = $mediaUrl . '/' . $imagePath;
            return $absoluteImagePath;
        } else {
            return "";
        }
    }

    /**
     * @return bool
     */
    public function isImageExists()
    {
        $params = $this->getRequest()->getParams();
        if (array_key_exists('banner_id', $params)) {
            $bannerId = $params['banner_id'];
            $banner = $this->bannerSlider->getBannerById($bannerId);
            if ($banner->getData()) {
                $rootPath = $this->directoryList->getRoot();
                $imagePath = $banner->getBanner();
                $file = $rootPath . "/pub/media/" . $imagePath;
                if (file_exists($file)) {
                    return true;
                }
                return false;
            } else {
                return false;
            }
        }
        return false;
    }
}