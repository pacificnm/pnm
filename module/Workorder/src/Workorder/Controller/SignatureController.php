<?php
namespace Workorder\Controller;

use Application\Controller\BaseController;
use Client\Service\ClientServiceInterface;
use Workorder\Service\WorkorderServiceInterface;
use Workorder\Form\SignatureForm;

class SignatureController extends BaseController
{
    /**
     * 
     * @var ClientServiceInterface
     */
    protected $clientService;
    
    /**
     * 
     * @var WorkorderServiceInterface
     */
    protected $workorderService;
    
    protected $signatureForm;
    /**
     * 
     * @param ClientServiceInterface $clientService
     * @param WorkorderServiceInterface $workorderService
     */
    public function __construct(ClientServiceInterface $clientService, WorkorderServiceInterface $workorderService, SignatureForm $signatureForm)
    {
        $this->clientService = $clientService;
        
        $this->workorderService = $workorderService;
        
        $this->signatureForm = $signatureForm;
    }
    
    /**
     * 
     * {@inheritDoc}
     * @see \Zend\Mvc\Controller\AbstractActionController::indexAction()
     */
    public function indexAction()
    {
        $id = $this->params()->fromRoute('clientId');
        
        $workorderId = $this->params()->fromRoute('workorderId');
        
        $request = $this->getRequest();
        
        $clientEntity = $this->clientService->get($id);
        
        if (! $clientEntity) {
            $this->flashmessenger()->addErrorMessage('Client was not found.');
        
            return $this->redirect()->toRoute('client-index');
        }
        
        $workorderEntity = $this->workorderService->get($workorderId);
        
        if (! $workorderEntity) {
            $this->flashmessenger()->addErrorMessage('Work Order was not found.');
        
            return $this->redirect()->toRoute('workorder-list', array(
                'clientId' => $id
            ));
        }
        
        // if we have a post
        if ($request->isPost()) {
            // get post
            $postData = $request->getPost();
            
            $this->signatureForm->setData($postData);
            
            // if we are valid
            if ($this->signatureForm->isValid()) {
                
                $workorderEntity->setWorkorderSignature($postData['workorderSignature']);
                
                $this->workorderService->save($workorderEntity);
                
                $this->flashMessenger()->addSuccessMessage('The signature was saved.');
                
                return $this->redirect()->toRoute('workorder-view', array('clientId' => $id, 'workorderId' => $workorderId));
            }
        }
        
        $this->flashMessenger()->addErrorMessage('The signature was not saved.');
        
        return $this->redirect()->toRoute('workorder-view', array('clientId' => $id, 'workorderId' => $workorderId));
    }
}

