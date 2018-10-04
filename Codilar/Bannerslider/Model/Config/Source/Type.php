<?php
/**
 * Created by PhpStorm.
 * User: mohith
 * Date: 20/9/18
 * Time: 5:14 PM
 */
namespace Codilar\Bannerslider\Model\Config\Source;

use Magento\Framework\Option\ArrayInterface;

class Type implements ArrayInterface
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
                'label' => 'Product Id',
                'value' => 1
            ],
            2 => [
                'label' => 'Category',
                'value' => 2
            ],

        ];

        return $options;
    }
}
