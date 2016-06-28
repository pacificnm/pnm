<?php
namespace Host\Controller;

use Application\Controller\BaseController;
use Client\Service\ClientServiceInterface;
use Zend\View\Model\ViewModel;
use Host\Service\HostServiceInterface;
use Host\Form\HostForm;

class UpdateController extends BaseController
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
     * @var HostForm
     */
    protected $hostForm;

    /**
     *
     * @param ClientServiceInterface $clientService            
     * @param HostServiceInterface $hostService            
     * @param HostForm $hostForm            
     */
    public function __construct(ClientServiceInterface $clientService, HostServiceInterface $hostService, HostForm $hostForm)
    {
        $this->clientService = $clientService;
        
        $this->hostService = $hostService;
        
        $this->hostForm = $hostForm;
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
        
        $hostEnity = $this->hostService->get($hostId);
        
        // validate host
        if (! $hostEnity) {
            $this->flashMessenger()->addErrorMessage('Host was not found');
            
            return $this->redirect()->toRoute('host-list', array(
                'clientId' => $id
            ));
        }
        
        // get request
        $request = $this->getRequest();
        
        // if we have a post
        if ($request->isPost()) {
            // get post
            $postData = $request->getPost();
        
            $this->hostForm->setData($postData);
        
            // if we are valid
            if ($this->hostForm->isValid()) {
        
                $entity = $this->hostForm->getData();
        
                $entity->setLocationId($postData->locationId);
        
                $entity = $this->hostService->save($entity);
        
                $this->flashmessenger()->addSuccessMessage('The host was saved');
        
                return $this->redirect()->toRoute('host-view', array(
                    'clientId' => $id,
                    'hostId' => $entity->getHostId()
                ));
            }
        }
        
        // set host entity
        $this->hostForm->bind($hostEnity);
        
        // set client id
        $this->hostForm->setClientId($id)->getLocation();
        
        // set layout vars
        $this->layout()->setVariable('clientId', $id);
        
        $this->layout()->setVariable('pageTitle', 'Edit Host');
        
        $this->layout()->setVariable('pageSubTitle', $clientEntity->getClientName());
        
        $this->layout()->setVariable('activeMenuItem', 'client');
        
        $this->layout()->setVariable('activeSubMenuItem', 'host-list');
        
        // set head title
        $this->setHeadTitle($clientEntity->getClientName());
        
        // return View
        return new ViewModel(array(
            'clientEntity' => $clientEntity,
            'clientId' => $id,
            'form' => $this->hostForm
        ));
    }
}