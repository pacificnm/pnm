<?php
namespace Panorama\View\Helper;

use Zend\View\Helper\AbstractHelper;
use Panorama\Service\DeviceServiceInterface;

class GetDeviceDetails extends AbstractHelper
{
    /**
     * 
     * @var DeviceServiceInterface
     */
    protected $deviceService;
    
    /**
     * 
     * @param DeviceServiceInterface $deviceService
     */
    public function __construct(DeviceServiceInterface $deviceService)
    {
        $this->deviceService = $deviceService;
    }
    
    public function __invoke($cid, $deviceId)
    {   
        $view = $this->getView();
        
        $partialHelper = $view->plugin('partial');
        
        $deviceEntity = $this->deviceService->getDevice($cid, $deviceId);
        
        $data = new \stdClass();
        
        $data->deviceEntity = $deviceEntity;
        
        return $partialHelper('partials/get-device-details.phtml', $data);
    }
}