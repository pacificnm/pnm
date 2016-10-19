<?php
namespace Panorama\Controller;

use Application\Controller\BaseController;
use Panorama\Service\MspServiceInterface;
use Zend\View\Model\ViewModel;
use Panorama\Service\IssueServiceInterface;
use Panorama\Service\DeviceServiceInterface;
use PanoramaClient\Service\PanoramaClientServiceInterface;

class ViewController extends BaseController
{

    /**
     *
     * @var MspServiceInterface
     */
    protected $mspService;

    /**
     *
     * @var IssueServiceInterface
     */
    protected $issueService;

    /**
     *
     * @var DeviceServiceInterface
     */
    protected $deviceService;

    /**
     * 
     * @var PanoramaClientServiceInterface
     */
    protected $panoramaClientService;
    
    /**
     * 
     * @param MspServiceInterface $mspService
     * @param DeviceServiceInterface $deviceService
     * @param PanoramaClientServiceInterface $panoramaClientService
     */
    public function __construct(MspServiceInterface $mspService,  DeviceServiceInterface $deviceService, PanoramaClientServiceInterface $panoramaClientService)
    {
        $this->mspService = $mspService;
        
        $this->deviceService = $deviceService;
        
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
        
        $mspEntity = $this->mspService->getClient($cid);
        
        $panoramaClientEntity = $this->panoramaClientService->getByCid($mspEntity->getCid());
        
        $paginator = $this->deviceService->getDevices($cid);
        
        $this->layout()->setVariable('pageTitle', 'Panorama9');
        
        $this->layout()->setVariable('pageSubTitle', $mspEntity->getName());
        
        $this->layout()->setVariable('activeMenuItem', 'panorama-index');
        
        $this->layout()->setVariable('activeSubMenuItem', 'panorama-index');
        
        return new ViewModel(array(
            'mspEntity' => $mspEntity,
            'paginator' => $paginator,
            'panoramaClientEntity' => $panoramaClientEntity
        ));
    }
}

?>