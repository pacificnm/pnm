<?php
namespace Panorama\Controller;

use Application\Controller\BaseController;
use Panorama\Service\MspServiceInterface;
use Panorama\Service\DeviceService;
use Zend\View\Model\ViewModel;


class DeviceController extends BaseController
{
    protected $mspService;
    
    protected $deviceService;
    
    public function __construct(MspServiceInterface $mspService, DeviceService $deviceService)
    {
        $this->mspService = $mspService;

        $this->deviceService = $deviceService;
    }
    
    /**
     * 
     * {@inheritDoc}
     * @see \Zend\Mvc\Controller\AbstractActionController::indexAction()
     */
    public function indexAction()
    {
        $cid = $this->params('cid');
        
        
        $deviceId = $this->params('deviceId');
        
        $mspEntity = $this->mspService->getClient($cid);
        
        
        
        $deviceEntity = $this->deviceService->getDevice($cid, $deviceId);
        
        return new ViewModel(array(
            'mspEntity' => $mspEntity,
            'deviceEntity' => $deviceEntity
        ));
    }
}