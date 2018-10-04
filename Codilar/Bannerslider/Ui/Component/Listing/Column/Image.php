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
 * @package     Codilar_BannerSlider
 * @copyright   Copyright (c) 2012 Codilar (http://www.Codilar.com/)
 * @license     http://www.Codilar.com/license-agreement.html
 */

namespace Codilar\Bannerslider\Ui\Component\Listing\Column;

use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Framework\View\Element\UiComponent\ContextInterface;

/**
 * @category Codilar
 * @package  Codilar_Storelocator
 * @module   Storelocator
 * @author   Codilar Developer
 */
class Image extends \Codilar\Bannerslider\Ui\Component\Listing\Column\AbstractColumn
{
    /**
     * default width and height image.
     */
    const IMAGE_WIDTH = '70%';
    const IMAGE_HEIGHT = '60';
    const IMAGE_STYLE = 'display: block;margin: auto;';

    /**
     * @var \Magento\Store\Model\StoreManagerInterface
     */
    protected $_storeManager;

    /**
     * Constructor.
     *
     * @param ContextInterface   $context
     * @param UiComponentFactory $uiComponentFactory
     * @param array              $components
     * @param array              $data
     */
    public function __construct(
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        \Magento\Framework\Filesystem $filesystem,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        array $components = [],
        array $data = []
    ) {
        parent::__construct($context, $uiComponentFactory, $components, $data);
        $this->_storeManager = $storeManager;
    }

    /**
     * prepare item.
     *
     * @param array $item
     *
     * @return array
     */
    protected function _prepareItem(array & $item)
    {
        $width = $this->hasData('width') ? $this->getWidth() : self::IMAGE_WIDTH;
        $height = $this->hasData('height') ? $this->getHeight() : self::IMAGE_HEIGHT;
        $style = $this->hasData('style') ? $this->getStyle() : self::IMAGE_STYLE;
        if (isset($item[$this->getData('name')])) {
            if ($item[$this->getData('name')]) {
                $srcImage = $this->_storeManager->getStore()
                        ->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA) . $item[$this->getData('name')];
                $item[$this->getData('name')] = sprintf(
                    '<img src="%s"  width="%s" height="%s" style="%s" />',
                    $srcImage,
                    $width,
                    $height,
                    $style
                );
            } else {
                $item[$this->getData('name')] = '';
            }
        }

        return $item;
    }
    public function prepareDataSource(array $dataSource)
    {
        foreach ($dataSource['data']['items'] as $key => $row){
            $image = $dataSource['data']['items'][$key]['image'];
            if($image != NULL){
                $dataSource['data']['items'][$key]['image'] = "someimage";
            }
        }
        return $dataSource;
    }
}
