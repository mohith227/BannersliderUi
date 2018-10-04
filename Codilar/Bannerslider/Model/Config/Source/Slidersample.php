<?php
/**
 * Created by PhpStorm.
 * User: mohith
 * Date: 20/9/18
 * Time: 8:49 PM
 */
namespace Codilar\Bannerslider\Model\Config\Source;

use Magento\Framework\Option\ArrayInterface;

class Slidersample implements ArrayInterface
{
    /**
     * @return array
     */
    public function toOptionArray()
    {
        $options = [
            0 => [
                'label' => 'Please select',
                'value' => 0
            ],
            1 => [
                'label' => 'slider1',
                'value' => 1
            ],
            2  => [
                'label' => 'slider2',
                'value' => 2
            ],
            3  => [
                'label' => 'slider3',
                'value' => 3
            ],
        ];

        return $options;
    }
}