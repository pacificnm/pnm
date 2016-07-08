<?php
namespace WorkorderPart\Controller;

use Application\Controller\BaseController;
use WorkorderPart\Service\PartServiceInterface;
use Workorder\Service\WorkorderServiceInterface;
use Client\Service\ClientServiceInterface;
use Zend\View\Model\ViewModel;

class DeleteController extends BaseController
{
    /**
     * 
     * @var ClientServiceInterface
     */
    protected $clientService;
    
    /**
     *
     * @var PartServiceInterface
     */
    protected $partService;
    
    /**
     *
     * @var WorkorderServiceInterface
     */
    protected $workorderService;
    
    /**
     * 
     * @param ClientServiceInterface $clientService
     * @param PartServiceInterface $partService
     * @param WorkorderServiceInterface $workorderService
     */
    public function __construct(ClientServiceInterface $clientService, PartServiceInterface $partService, WorkorderServiceInterface $workorderService)
    {
        $this->clientService = $clientService;
        
        $this->partService = $partService;
        
        $this->workorderService = $workorderService;
    }
    
    /**
     * 
     * {@inheritDoc}
     * @see \Zend\Mvc\Controller\AbstractActionController::indexAction()
     */
    public function indexAction()
    {
        $clientId = $this->params()->fromRoute('clientId');
        
        $workorderId = $this->params()->fromRoute('workorderId');
        
        $workorderPartId = $this->params()->fromRoute('workorderPartId');
        
        $clientEntity = $this->clientService->get($clientId);
        
        if (! $clientEntity) {
            $this->flashmessenger()->addErrorMessage('Client was not found.');
        
            return $this->redirect()->toRoute('client-index');
        }
        
        $workorderEntity = $this->workorderService->get($workorderId);
        
        if (! $workorderEntity) {
            $this->flashmessenger()->addErrorMessage('Work Order was not found.');
        
            return $this->redirect()->toRoute('workorder-list', array(
                'clientId' => $clientId
            ));
        }
        
        $workorderPartEntity = $this->partService->get($workorderPartId);
        
        if(! $workorderPartEntity) {
            $this->flashmessenger()->addErrorMessage('Work Order part was not found.');
            
            return $this->redirect()->toRoute('workorder-view', array(
                'clientId' => $clientId, 'workorderId' => $workorderId
            ));
        }
        
        $this->layout()->setVariable('clientId', $clientId);
        
        $this->layout()->setVariable('pageTitle', 'Delete Work Order Part');
        
        $this->layout()->setVariable('pageSubTitle', $clientEntity->getClientName());
        
        $this->layout()->setVariable('activeMenuItem', 'client');
        
        $this->layout()->setVariable('activeSubMenuItem', 'workorder-list');
        
        $this->setHeadTitle($clientEntity->getClientName());
        
        $request = $this->getRequest();
        
        if ($request->isPost()) {
            $del = $request->getPost('delete_confirmation', 'no');
        
            if ($del === 'yes') {
                
                $workorderEntity->setWorkorderParts($workorderEntity->getWorkorderParts() - $workorderPartEntity->getWorkorderPartsTotal());
                
                $this->workorderService->save($workorderEntity);
                
                $this->partService->delete($workorderPartEntity);
                
                $this->flashmessenger()->addSuccessMessage('The work order part was deleted');
            }
            
            return $this->redirect()->toRoute('workorder-view', array(
                'clientId' => $clientId,
                'workorderId' => $workorderId,
               
            ));
        }
        
        // return view
        return new ViewModel(array(
            'clientEntity' => $clientEntity,
            'clientId' => $clientId,
             'partEntity' => $workorderPartEntity
        ));
    }
}