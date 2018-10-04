<?php
/**
 * Created by PhpStorm.
 * User: mohith
 * Date: 19/9/18
 * Time: 2:37 PM
 */
namespace Codilar\Bannerslider\Model\Config\Source;

use Magento\Framework\Option\ArrayInterface;

class Options implements ArrayInterface
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
                'label' => 'Option 1',
                'value' => 1
            ],
            2  => [
                'label' => 'Option 2',
                'value' => 2
            ],
            3 => [
                'label' => 'Option 3',
                'value' => 3
            ],
        ];

        return $options;
    }
}