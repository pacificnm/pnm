<?php
namespace Host\Controller;

use Application\Controller\BaseController;
use Client\Service\ClientServiceInterface;
use Zend\View\Model\ViewModel;
use Host\Service\HostServiceInterface;

class DeleteController extends BaseController
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
     * @param ClientServiceInterface $clientService            
     * @param HostServiceInterface $hostservice            
     */
    public function __construct(ClientServiceInterface $clientService, HostServiceInterface $hostservice)
    {
        $this->clientService = $clientService;
        
        $this->hostService = $hostservice;
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
        
        // validate client
        if (! $clientEntity) {
            $this->flashMessenger()->addErrorMessage('Client was not found');
            
            return $this->redirect()->toRoute('client-index');
        }
        
        $hostEntity = $this->hostService->get($hostId);
        
        // validate host
        if (! $hostEntity) {
            $this->flashMessenger()->addErrorMessage('Host was not found');
            
            return $this->redirect()->toRoute('host-view', array(
                'clientId' => $id
            ));
        }
        
        // get request
        $request = $this->getRequest();
        
        // we have post
        if ($request->isPost()) {
            $del = $request->getPost('delete_confirmation', 'no');
            
            if ($del === 'yes') {
                $hostEntity->setHostStatus('Deleted');
                
                $this->hostService->save($hostEntity);
                
                $this->flashMessenger()->addSuccessMessage('The host was deleted');
                
                return $this->redirect()->toRoute('host-list', array(
                    'clientId' => $id
                ));
            }
            
            // return to view
            return $this->redirect()->toRoute('host-view', array(
                'clientId' => $id,
                'hostId' => $hostId
            ));
        }
        
        // set layout vars
        $this->layout()->setVariable('clientId', $id);
        
        $this->layout()->setVariable('pageTitle', 'Delete Host');
        
        $this->layout()->setVariable('pageSubTitle', $clientEntity->getClientName());
        
        $this->layout()->setVariable('activeMenuItem', 'client');
        
        $this->layout()->setVariable('activeSubMenuItem', 'host-list');
        
        // set head title
        $this->setHeadTitle($clientEntity->getClientName());
        // return View
        return new ViewModel(array(
            'clientEntity' => $clientEntity,
            'clientId' => $id,
            'hostEntity' => $hostEntity
        ));
    }
}