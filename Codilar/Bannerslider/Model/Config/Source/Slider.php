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
 * @copyright   Copyright (c) 2012-2016 Codilar (http://www.Codilar.com/)
 * @license     http://www.Codilar.com/license-agreement.html
 */

namespace Codilar\Bannerslider\Model\Config\Source;

class Slider implements \Magento\Framework\Option\ArrayInterface
{
    protected $sliderFactory;

    public function __construct(
        \Codilar\Bannerslider\Model\SliderFactory $sliderFactory
    ) {
        $this->sliderFactory = $sliderFactory;
    }

    public function getSliders()
    {
        $sliderModel = $this->sliderFactory->create();
        return $sliderModel->getCollection()->getData();
    }

    public function toOptionArray()
    {
        $sliders = [];
        foreach ($this->getSliders() as $slider) {
            array_push($sliders,[
                'value' => $slider['slider_id'],
                'label' => $slider['title']
            ]);
        }
        return $sliders;
    }
}