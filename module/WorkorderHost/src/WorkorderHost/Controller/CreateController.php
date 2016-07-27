<?php
namespace WorkorderHost\Controller;

use Application\Controller\BaseController;
use WorkorderHost\Service\WorkorderHostServiceInterface;
use WorkorderHost\Form\WorkorderHostForm;

class CreateController extends BaseController
{

    protected $workorderHostService;

    protected $workorderHostForm;

    /**
     *
     * @param WorkorderHostServiceInterface $workorderHostService            
     * @param WorkorderHostForm $workorderHostForm            
     */
    public function __construct(WorkorderHostServiceInterface $workorderHostService, WorkorderHostForm $workorderHostForm)
    {
        $this->workorderHostService = $workorderHostService;
        
        $this->workorderHostForm = $workorderHostForm;
    }

    /**
     * 
     * {@inheritDoc}
     * @see \Zend\Mvc\Controller\AbstractActionController::indexAction()
     */
    public function indexAction()
    {
        $request = $this->getRequest();
        
        $clientId = $this->params()->fromRoute('clientId');
        
        $workorderId = $this->params()->fromRoute('workorderId');
        
        $this->workorderHostForm->setClientId($clientId);
        
        $this->workorderHostForm->setWorkorderId($workorderId);
        
        $this->workorderHostForm->getFormElements();
        
        // if we have a post
        if ($request->isPost()) {
            
            $postData = $request->getPost();
            
            $this->workorderHostForm->setData($postData);
            
            if($this->workorderHostForm->isValid()) {
                
                $entity = $this->workorderHostForm->getData();
                
                $workorderHostEntity = $this->workorderHostService->save($entity);
                
                $this->SetWorkorderHistory($this->getRequest()
                    ->getUri(), 'CREATE', $this->identity()
                    ->getAuthId(), "Added host {$workorderHostEntity->getHostEntity()->getHostName()} to work order #{$workorderId}", $workorderId);
                
                $this->flashMessenger()->addSuccessMessage('The host was added to the work order.');
            } else {
                $this->flashMessenger()->addErrorMessage('The host was not added to the work order.');
            }
        }
        
        return $this->redirect()->toRoute('workorder-view', array(
            'clientId' => $clientId,
            'workorderId' => $workorderId
        ));
    }
}

