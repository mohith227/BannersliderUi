<?php
/**
 * Created by PhpStorm.
 * User: mohith
 * Date: 20/9/18
 * Time: 1:50 PM
 */
namespace Codilar\Bannerslider\Model\Config\Source;

use Magento\Framework\Option\ArrayInterface;

class Target implements ArrayInterface
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
                'label' => 'New Window with Browser Navigation',
                'value' => 1
            ],
            2  => [
                'label' => 'Parent Window with Browser Navigation',
                'value' => 2
            ],
            3  => [
                'label' => 'New Window without Browser Navigation',
                'value' => 3
            ],
        ];

        return $options;
    }
}