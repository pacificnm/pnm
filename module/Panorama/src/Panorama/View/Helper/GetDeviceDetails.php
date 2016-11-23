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
        
        $data = new \stdClass();
        
        try {
            $deviceEntity = $this->deviceService->getDevice($cid, $deviceId);
            $data->deviceEntity = $deviceEntity;
        } catch (\Exception $e) {
            $data->deviceEntity = null;
        }
        
        
        
        return $partialHelper('partials/get-device-details.phtml', $data);
    }
}