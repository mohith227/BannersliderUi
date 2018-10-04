<?php
/**
 * Created by PhpStorm.
 * User: mohith
 * Date: 20/9/18
 * Time: 11:09 AM
 */
namespace Codilar\Bannerslider\Block\Adminhtml\Banner\Edit;

use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;

/**
 * Class SaveButton
 */
class SaveButton extends GenericButton implements ButtonProviderInterface
{
    /**
     * @return array
     */
    public function getButtonData()
    {
        return [
            'label' => __('Save Banner'),
//            'on_click' => sprintf("location.href = '%s';", $this->getSaveUrl()),
            'class' => 'save primary',
            'data_attribute' => [
                'mage-init' => ['button' => ['event' => 'save']],
                'form-role' => 'save',
            ],
            'sort_order' => 90,
        ];
    }
//    public function getSaveUrl()
//    {
//        return $this->getUrl('bannerslideradmin/banner/save');
//    }
}