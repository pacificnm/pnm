<?php
namespace Panorama\Controller;

use Application\Controller\BaseController;
use Panorama\Service\MspServiceInterface;
use Zend\View\Model\ViewModel;
use Panorama\Service\IssueServiceInterface;
use Panorama\Service\DeviceServiceInterface;

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
     * @param MspServiceInterface $mspService            
     * @param IssueServiceInterface $issueService            
     * @param DeviceServiceInterface $deviceService            
     */
    public function __construct(MspServiceInterface $mspService, IssueServiceInterface $issueService, DeviceServiceInterface $deviceService)
    {
        $this->mspService = $mspService;
        
        $this->issueService = $issueService;
        
        $this->deviceService = $deviceService;
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
        
        $paginator = $this->deviceService->getDevices($cid);
        
        $this->layout()->setVariable('pageTitle', 'Panorama9');
        
        $this->layout()->setVariable('pageSubTitle', $mspEntity->getName());
        
        $this->layout()->setVariable('activeMenuItem', 'panorama-index');
        
        $this->layout()->setVariable('activeSubMenuItem', 'panorama-index');
        
        return new ViewModel(array(
            'mspEntity' => $mspEntity,
            'paginator' => $paginator
        ));
    }
}

?>