<?php
namespace Host\Controller;

use Application\Controller\BaseController;
use Client\Service\ClientServiceInterface;
use Zend\View\Model\ViewModel;
use Host\Service\HostServiceInterface;
use Host\Form\HostForm;

class CreateController extends BaseController
{

    /**
     *
     * @var ClientServiceInterface
     */
    protected $clientService;

    protected $hostService;

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
        
        $clientEntity = $this->clientService->get($id);
        
        if (! $clientEntity) {
            
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
        
        
        // set form defaults
        $this->hostForm->setClientId($id)->getLocation();
        
        $this->hostForm->get('hostId')->setValue(0);

        $this->hostForm->get('clientId')->setValue($id);
        
        $this->hostForm->get('hostHealth')->setValue('Not Enabled');
        
        $this->hostForm->get('hostCreated')->setValue(time());
        
        // set layout defaults
        $this->layout()->setVariable('clientId', $id);
        
        $this->layout()->setVariable('pageTitle', 'Create Host');
        
        $this->layout()->setVariable('pageSubTitle', $clientEntity->getClientName());

        $this->layout()->setVariable('activeMenuItem', 'client');
        
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