<?php
namespace WorkorderTime\Controller;

use Application\Controller\BaseController;
use WorkorderTime\Service\TimeServiceInterface;
use Workorder\Service\WorkorderServiceInterface;
use Client\Service\ClientServiceInterface;
use Zend\View\Model\ViewModel;

class DeleteController extends BaseController
{

    protected $clientService;

    /**
     *
     * @var TimeServiceInterface
     */
    protected $timeService;

    /**
     *
     * @var WorkorderServiceInterface
     */
    protected $workorderService;

    public function __construct(ClientServiceInterface $clientService, TimeServiceInterface $timeService, WorkorderServiceInterface $workorderService)
    {
        $this->clientService = $clientService;
        
        $this->timeService = $timeService;
        
        $this->workorderService = $workorderService;
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
        
        $workorderId = $this->params()->fromRoute('workorderId');
        
        $workorderTimeId = $this->params()->fromRoute('workorderTimeId');
        
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
        
        $workorderTimeEntity = $this->timeService->get($workorderTimeId);
        
        if (! $workorderTimeEntity) {
            $this->flashmessenger()->addErrorMessage('Work Order Time was not found.');
            
            return $this->redirect()->toRoute('workorder-view', array(
                'clientId' => $id,
                'workorderId' => $workorderId
            ));
        }
        
        $this->layout()->setVariable('clientId', $id);
        
        $this->layout()->setVariable('pageTitle', 'Delete Work Order Time');
        
        $this->layout()->setVariable('pageSubTitle', $clientEntity->getClientName());
        
        $this->layout()->setVariable('activeMenuItem', 'client');
        
        $this->layout()->setVariable('activeSubMenuItem', 'workorder-list');
        
        $this->setHeadTitle($clientEntity->getClientName());
        
        $request = $this->getRequest();
        
        if ($request->isPost()) {
            $del = $request->getPost('delete_confirmation', 'no');
            
            if ($del === 'yes') {
                
                $workorderEntity->setWorkorderLabor($workorderEntity->getWorkorderLabor() - $workorderTimeEntity->getLaborTotal());
                
                $this->workorderService->save($workorderEntity);
                
                $this->timeService->delete($workorderTimeEntity);
                
                
                $this->flashmessenger()->addSuccessMessage('The work order time was deleted');
            }
            
            return $this->redirect()->toRoute('workorder-view', array(
                'clientId' => $id,
                'workorderId' => $workorderId
            ));
        }
        
        return new ViewModel(array(
            'clientEntity' => $clientEntity,
            'clientId' => $id,
            'workorderTimeEntity' => $workorderTimeEntity
        ));
    }
}