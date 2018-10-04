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
 * @copyright   Copyright (c) 2012 Codilar (http://www.Codilar.com/)
 * @license     http://www.Codilar.com/license-agreement.html
 */

namespace Codilar\Bannerslider\Model\ResourceModel\Report;

/**
 * Report Collection
 * @category Codilar
 * @package  Codilar_Bannerslider
 * @module   Bannerslider
 * @author   Codilar Developer
 */
class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    const REPORT_TYPE_ALL_SLIDER = '1';
    const REPORT_TYPE_PER_SLIDER = '2';


    protected $_idFieldName = 'report_id';
    /**
     * store view id.
     *
     * @var int
     */
    protected $_storeViewId = null;

    /**
     * @var \Magento\Store\Model\StoreManagerInterface
     */
    protected $_storeManager;

    /**
     * added table
     * @var array
     */
    protected $_addedTable = [];

    /**
     * @var bool
     */
    protected $_isLoadSliderTitle = FALSE;

    /**
     * @var \Magento\Framework\Stdlib\DateTime\Timezone
     */
    protected $_stdTimezone;

    /**
     * _contruct
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Codilar\Bannerslider\Model\Report', 'Codilar\Bannerslider\Model\ResourceModel\Report');
    }

    /**
     * @param \Magento\Framework\Data\Collection\EntityFactoryInterface    $entityFactory
     * @param \Psr\Log\LoggerInterface                                     $logger
     * @param \Magento\Framework\Data\Collection\Db\FetchStrategyInterface $fetchStrategy
     * @param \Magento\Framework\Event\ManagerInterface                    $eventManager
     * @param \Zend_Db_Adapter_Abstract                                    $connection
     * @param \Magento\Framework\Model\ResourceModel\Db\AbstractDb              $resource
     */
    public function __construct(
        \Magento\Framework\Data\Collection\EntityFactoryInterface $entityFactory,
        \Psr\Log\LoggerInterface $logger,
        \Magento\Framework\Data\Collection\Db\FetchStrategyInterface $fetchStrategy,
        \Magento\Framework\Event\ManagerInterface $eventManager,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Magento\Framework\Stdlib\DateTime\Timezone $stdTimezone,
        $connection = null,
        \Magento\Framework\Model\ResourceModel\Db\AbstractDb $resource = null
    ) {
        parent::__construct($entityFactory, $logger, $fetchStrategy, $eventManager, $connection, $resource);
        $this->_storeManager = $storeManager;
        $this->_stdTimezone = $stdTimezone;

    }


    /**
     * load slider and banner information to report
     */
    public function reportClickAndImpress($reportType)
    {
        $this->getSelect()->joinLeft(
            ['table_banner' => $this->getTable('Codilar_bannerslider_banner')],
            'main_table.banner_id = table_banner.banner_id',
            ['banner_name' => 'table_banner.name', 'banner_url' => 'table_banner.click_url']
        )->joinLeft(
            ['table_slider' => $this->getTable('Codilar_bannerslider_slider')],
            'main_table.slider_id = table_slider.slider_id',
            ['slider_title' => 'table_slider.title']
        )->columns('SUM(main_table.clicks) AS banner_click')
            ->columns('SUM(main_table.impmode) AS banner_impress');

        if ($reportType == self::REPORT_TYPE_ALL_SLIDER) {
            $this->getSelect()->group('main_table.banner_id');
        } else if ($reportType == self::REPORT_TYPE_PER_SLIDER) {
            $this->getSelect()->group('main_table.slider_id')
                ->group('main_table.banner_id');
        }

        return $this;
    }
}
