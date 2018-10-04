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
class Slider extends \Codilar\Bannerslider\Ui\Component\Listing\Column\AbstractColumn
{

    /**
     * @var \Magento\Store\Model\StoreManagerInterface
     */
    protected $_storeManager;

    /**
     * @var \Codilar\Bannerslider\Model\SliderFactory
     */
    protected $_sliderFactory;
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
        \Codilar\Bannerslider\Model\SliderFactory $sliderFactory,
        array $components = [],
        array $data = []
    ) {
        parent::__construct($context, $uiComponentFactory, $components, $data);
        $this->_storeManager = $storeManager;
        $this->_sliderFactory = $sliderFactory;
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
        $slider = $this->_sliderFactory->create()->load($item[$this->getData('name')]);

        if (isset($item[$this->getData('name')])) {
            if ($item[$this->getData('name')]) {

                $item[$this->getData('name')] = sprintf(
                    '%s',
                    $slider->getTitle()
                );
            } else {
                $item[$this->getData('name')] = '';
            }
        }

        return $item;
    }
}
