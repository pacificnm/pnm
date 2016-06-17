<?php
namespace Client\Controller;

use Application\Controller\BaseController;
use Client\Service\ClientServiceInterface;
use Zend\View\Model\ViewModel;
use Workorder\Service\WorkorderServiceInterface;
use Invoice\Service\InvoiceServiceInterface;
use Task\Service\TaskServiceInterface;
use Location\Service\LocationServiceInterface;
use User\Service\UserServiceInterface;

class ViewController extends BaseController
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
     * @var InvoiceServiceInterface
     */
    protected $invoiceService;

    /**
     *
     * @var TaskServiceInterface
     */
    protected $taskService;

    /**
     *
     * @var LocationServiceInterface
     */
    protected $locationService;

    /**
     *
     * @var UserServiceInterface
     */
    protected $userService;

    /**
     *
     * @param ClientServiceInterface $clientService            
     * @param WorkorderServiceInterface $workorderService            
     * @param InvoiceServiceInterface $invoiceService            
     * @param TaskServiceInterface $taskService            
     * @param LocationServiceInterface $locationService            
     * @param UserServiceInterface $userService            
     */
    public function __construct(ClientServiceInterface $clientService, WorkorderServiceInterface $workorderService, InvoiceServiceInterface $invoiceService, TaskServiceInterface $taskService, LocationServiceInterface $locationService, UserServiceInterface $userService)
    {
        $this->clientService = $clientService;
        
        $this->workorderService = $workorderService;
        
        $this->invoiceService = $invoiceService;
        
        $this->taskService = $taskService;
        
        $this->locationService = $locationService;
        
        $this->userService = $userService;
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
            $this->flashmessenger()->addErrorMessage('Client was not found.');
            
            return $this->redirect()->toRoute('client-index');
        }
        
        // set history
        $this->setHistory($this->getRequest()
            ->getUri(), 'READ', $this->identity()
            ->getAuthId(), 'View Client ' . $clientEntity->getClientName());
        
        // set layout vars
        $this->layout()->setVariable('clientId', $id);
        
        $this->layout()->setVariable('pageTitle', 'View Client');
        
        $this->layout()->setVariable('pageSubTitle', $clientEntity->getClientName());
        
        // set head title
        $this->setHeadTitle($clientEntity->getClientName());
        
        // get workorders
        $workorderEntitys = $this->workorderService->getClientActiveWorkOrders($id);
        
        $workorderTotalCount = $this->workorderService->getClientTotalCount($id, 'Closed');
        
        $workorderLaborTotal = $this->workorderService->getClientTotalLabor($id);
        
        $workorderPartTotal = $this->workorderService->getClientTotalPart($id);
        
        $workorderRevenuTotal = $workorderLaborTotal + $workorderPartTotal;
        
        // get locations
        $locationEntitys = $this->locationService->getClientLocations($id);
        
        // get un-paid invoices
        $invoiceEntitys = $this->invoiceService->getClientUnpaidInvoices($id);
        
        // get active tasks
        $taskEntitys = $this->taskService->getClientActiveTasks($id);
        
        // get primary user
        $userEntity = $this->userService->getClientPrimaryUser($id);
        
        // return view model
        return new ViewModel(array(
            'clientEntity' => $clientEntity,
            'clientId' => $id,
            'workorderEntitys' => $workorderEntitys,
            'workorderTotalCount' => $workorderTotalCount,
            'workorderLaborTotal' => $workorderLaborTotal,
            'workorderPartTotal' => $workorderPartTotal,
            'workorderRevenuTotal' => $workorderRevenuTotal,
            'invoiceEntitys' => $invoiceEntitys,
            'taskEntitys' => $taskEntitys,
            'locationEntitys' => $locationEntitys,
            'userEntity' => $userEntity
        ));
    }
}
