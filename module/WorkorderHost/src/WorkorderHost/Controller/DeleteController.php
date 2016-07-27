<?php
namespace WorkorderHost\Controller;

use Application\Controller\BaseController;
use WorkorderHost\Service\WorkorderHostService;
use Zend\View\Model\ViewModel;

class DeleteController extends BaseController
{

    protected $workorderHostService;

    public function __construct(WorkorderHostService $workorderHostService)
    {
        $this->workorderHostService = $workorderHostService;
    }

    public function indexAction()
    {
        $clientId = $this->params()->fromRoute('clientId');
        
        $workorderId = $this->params()->fromRoute('workorderId');
        
        $workorderHostId = $this->params()->fromRoute('workorderHostId');
        
        $request = $this->getRequest();
        
        $workorderHostEntity = $this->workorderHostService->get($workorderHostId);
        
        // if we have a post
        if ($request->isPost()) {
            
            $del = $request->getPost('delete_confirmation', 'no');
            
            if ($del === 'yes') {
                
                $this->workorderHostService->delete($workorderHostEntity);
                
                $this->flashmessenger()->addSuccessMessage('The host was removed from the work order');
                
                // record history
                $this->SetWorkorderHistory($this->getRequest()
                    ->getUri(), 'DELETE', $this->identity()
                    ->getAuthId(), "Removed host {$workorderHostEntity->getHostEntity()->getHostName()} from work order #{$workorderId}", $workorderId);
            }
            
            return $this->redirect()->toRoute('workorder-view', array(
                'clientId' => $clientId,
                'workorderId' => $workorderId
            ));
        }
        
        // set layout vars
        $this->layout()->setVariable('clientId', $clientId);
        
        $this->layout()->setVariable('pageTitle', 'Remove Host From Work Order');
        
        $this->layout()->setVariable('pageSubTitle', '');
        
        $this->layout()->setVariable('activeMenuItem', 'client');
        
        $this->layout()->setVariable('activeSubMenuItem', 'workorder-list');
        
        return new ViewModel(array(
            'workorderHostEntity' => $workorderHostEntity
        ));
    }
}

