<?php
namespace Panorama\Controller;

use Application\Controller\BaseController;
use Panorama\Service\MspServiceInterface;
use Panorama\Service\DeviceService;
use Zend\View\Model\ViewModel;
use PanoramaHost\Service\PanoramaHostServiceInterface;
use PanoramaClient\Service\PanoramaClientServiceInterface;

class DeviceController extends BaseController
{

    /**
     *
     * @var MspServiceInterface
     */
    protected $mspService;

    /**
     *
     * @var DeviceService
     */
    protected $deviceService;

    /**
     * 
     * @var PanoramaHostServiceInterface
     */
    protected $panoramaHostService;
    
    /**
     * 
     * @var PanoramaClientServiceInterface
     */
    protected $panoramaClientService;
    
    /**
     * 
     * @param MspServiceInterface $mspService
     * @param DeviceService $deviceService
     * @param PanoramaHostServiceInterface $panoramaHostService
     * @param PanoramaClientServiceInterface $panoramaClientService
     */
    public function __construct(MspServiceInterface $mspService, DeviceService $deviceService, PanoramaHostServiceInterface $panoramaHostService, PanoramaClientServiceInterface $panoramaClientService)
    {
        $this->mspService = $mspService;
        
        $this->deviceService = $deviceService;
        
        $this->panoramaHostService = $panoramaHostService;
        
        $this->panoramaClientService = $panoramaClientService;
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \Zend\Mvc\Controller\AbstractActionController::indexAction()
     */
    public function indexAction()
    {
        $cid = $this->params('cid');
        
        $deviceId = $this->params('deviceId');
        
        $mspEntity = $this->mspService->getClient($cid);
        
        $deviceEntity = $this->deviceService->getDevice($cid, $deviceId);
        
        $panoramaClientEntity = $this->panoramaClientService->getByCid($mspEntity->getCid());
        
        $panoramaHostEntity = $this->panoramaHostService->getByDeviceId($deviceId);
        
        return new ViewModel(array(
            'mspEntity' => $mspEntity,
            'deviceEntity' => $deviceEntity,
            'panoramaClientEntity' => $panoramaClientEntity,
            'panoramaHostEntity' => $panoramaHostEntity,
        ));
    }
}