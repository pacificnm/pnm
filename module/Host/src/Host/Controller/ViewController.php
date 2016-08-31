<?php
namespace Host\Controller;

use Application\Controller\BaseController;
use Client\Service\ClientServiceInterface;
use Zend\View\Model\ViewModel;
use Host\Service\HostServiceInterface;
use HostAttributeMap\Service\MapServiceInterface;
use Zabbix\Client;
use Zabbix\Zabbix;

class ViewController extends BaseController
{

    /**
     *
     * @var ClientServiceInterface
     */
    protected $clientService;

    /**
     *
     * @var HostServiceInterface
     */
    protected $hostService;

    /**
     * 
     * @var MapServiceInterface
     */
    protected $mapService;
    
    /**
     * 
     * @param ClientServiceInterface $clientService
     * @param HostServiceInterface $hostService
     * @param MapServiceInterface $mapService
     */
    public function __construct(ClientServiceInterface $clientService, HostServiceInterface $hostService, MapServiceInterface $mapService)
    {
        $this->clientService = $clientService;
        
        $this->hostService = $hostService;
        
        $this->mapService = $mapService;
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \Zend\Mvc\Controller\AbstractActionController::indexAction()
     */
    public function indexAction()
    {
        $id = $this->params()->fromRoute('clientId');
        
        $hostId = $this->params()->fromRoute('hostId');
        
        $clientEntity = $this->clientService->get($id);
        
        // validate host
        if (! $clientEntity) {
            $this->flashMessenger()->addErrorMessage('Could not find the client');
            
            return $this->redirect()->toRoute('client-index');
        }
        
        $hostEntity = $this->hostService->get($hostId);
        
        if (! $hostEntity) {
            $this->flashMessenger()->addErrorMessage('Could not find host');
            
            return $this->redirect()->toRoute('host-list', array(
                'clientId' => $id
            ));
        }
        
        // load attributes
        $mapEnitys = $this->mapService->getHostAttributes($hostId);
        
        // set up layout
        $this->layout()->setVariable('clientId', $id);
        
        $this->layout()->setVariable('pageTitle', 'View Host');
        
        $this->layout()->setVariable('pageSubTitle', $clientEntity->getClientName());
        
        $this->layout()->setVariable('activeMenuItem', 'client');
        
        $this->layout()->setVariable('activeSubMenuItem', 'host-list');
        
        $this->setHeadTitle($clientEntity->getClientName());
        
                
        // return View
        return new ViewModel(array(
            'clientEntity' => $clientEntity,
            'clientId' => $id,
            'hostEntity' => $hostEntity,
            'mapEnitys' => $mapEnitys
        ));
    }
}