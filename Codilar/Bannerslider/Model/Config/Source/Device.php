<?php
/**
 * Created by PhpStorm.
 * User: mohith
 * Date: 20/9/18
 * Time: 11:48 AM
 */
namespace Codilar\Bannerslider\Model\Config\Source;

use Magento\Framework\Option\ArrayInterface;

class Device implements ArrayInterface
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
                'label' => 'Desktop',
                'value' => 1
            ],
            2  => [
                'label' => 'Mobile',
                'value' => 2
            ],
        ];

        return $options;
    }
}