<?php
namespace WorkorderEmployee\Controller;

use Application\Controller\BaseController;
use Client\Service\ClientServiceInterface;
use Workorder\Service\WorkorderServiceInterface;
use WorkorderEmployee\Service\WorkorderEmployeeServiceInterface;
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
     * @var WorkorderServiceInterface
     */
    protected $workorderService;

    /**
     *
     * @var WorkorderEmployeeServiceInterface
     */
    protected $employeeService;

    /**
     *
     * @param ClientServiceInterface $clientService            
     * @param WorkorderServiceInterface $workorderService            
     * @param WorkorderEmployeeServiceInterface $employeeService            
     */
    public function __construct(ClientServiceInterface $clientService, WorkorderServiceInterface $workorderService, WorkorderEmployeeServiceInterface $employeeService)
    {
        $this->clientService = $clientService;
        
        $this->workorderService = $workorderService;
        
        $this->employeeService = $employeeService;
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \Zend\Mvc\Controller\AbstractActionController::indexAction()
     */
    public function indexAction()
    {
        $workorderId = $this->params()->fromRoute('workorderId');
        
        $clientId = $this->params()->fromRoute('clientId');
        
        $employeeId = $this->params()->fromRoute('employeeId');
        
        $request = $this->getRequest();
        
        // get client
        $clientEntity = $this->clientService->get($clientId);
        
        // validate client
        if (! $clientEntity) {
            $this->flashmessenger()->addErrorMessage('Client was not found.');
            
            return $this->redirect()->toRoute('client-list');
        }
        
        // get work order
        $workorderEntity = $this->workorderService->get($workorderId);
        
        // validate work order
        if (! $workorderEntity) {
            $this->flashmessenger()->addErrorMessage('Work Order was not found.');
            
            return $this->redirect()->toRoute('workorder-list', array(
                'clientId' => $clientId
            ));
        }
        
        // get employee
        $employeeEntity = $this->employeeService->getEmployeeWorkorder($employeeId, $workorderId);
        
        // validate employee
        if (! $employeeEntity) {
            $this->flashMessenger()->addErrorMessage('Can not find employee');
            
            return $this->redirect()->toRoute('workorder-view', array(
                'clientId' => $clientId,
                'workorderId' => $workorderId
            ));
        }
        
        // if we have a post
        if ($request->isPost()) {
            
            $del = $request->getPost('delete_confirmation', 'no');
        
            if ($del === 'yes') {
        
                $this->employeeService->delete($employeeEntity);
        
                $this->flashmessenger()->addSuccessMessage('The employee was removed from the work order');
                
                // @todo send email to employee to inform them they have been removed
                
                // record history
                $this->setHistory($this->getRequest()
                    ->getUri(), 'DELETE', $this->identity()
                    ->getAuthId(), "Removed employee {$employeeEntity->getEmployeeEntity()->getEmployeeName()} from work order #{$workorderId}");
            }
        
            return $this->redirect()->toRoute('workorder-view', array(
                'clientId' => $clientId,
                'workorderId' => $workorderId
            ));
        }
        
        
        // set layout vars
        $this->layout()->setVariable('clientId', $clientId);
        
        $this->layout()->setVariable('pageTitle', 'Remove Employee From Work Order');
        
        $this->layout()->setVariable('pageSubTitle', $clientEntity->getClientName());
        
        $this->layout()->setVariable('activeMenuItem', 'client');
        
        $this->layout()->setVariable('activeSubMenuItem', 'workorder-list');
        
        // return view model
        return new ViewModel(array(
            'employeeEntity' => $employeeEntity
        ));
    }
}