<?php
/*
 * Sample_Example

 * @category   Sample
 * @package    Sample_Example
 * @copyright  Copyright (c) 2017 Sample
 * @license    https://github.com/turiknox/magento2-sample-imageuploader/blob/master/LICENSE.md
 * @version    1.0.0
 */
namespace Codilar\Bannerslider\Model;

use Magento\Framework\ObjectManagerInterface;

class UploaderPool
{
    /**
     * @var ObjectManagerInterface
     */
    protected $objectManager;

    /**
     * @var array
     */
    protected $uploaders;

    /**
     * @param ObjectManagerInterface $objectManager
     * @param array $uploaders
     */
    public function __construct(
        ObjectManagerInterface $objectManager,
        array $uploaders = []
    ) {
        $this->objectManager = $objectManager;
        $this->uploaders     = $uploaders;
    }

    /**
     * @param $type
     * @return Uploader
     * @throws \Exception
     */
    public function getUploader($type)
    {
        if (!isset($this->uploaders[$type])) {
            throw new \Exception("Uploader not found for type: ".$type);
        }
        if (!is_object($this->uploaders[$type])) {
            $this->uploaders[$type] = $this->objectManager->create($this->uploaders[$type]);
        }
        $uploader = $this->uploaders[$type];
        if (!($uploader instanceof Uploader)) {
            throw new \Exception("Uploader for type {$type} not instance of ". Uploader::class);
        }
        return $uploader;
    }
}
