<?php
namespace Client\Controller;

use Application\Controller\BaseController;
use Client\Service\ClientServiceInterface;
use Zend\View\Model\ViewModel;
use Workorder\Service\WorkorderServiceInterface;
use Invoice\Service\InvoiceServiceInterface;
use Task\Service\TaskServiceInterface;

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
     * @param ClientServiceInterface $clientService
     * @param WorkorderServiceInterface $workorderService
     * @param InvoiceServiceInterface $invoiceService
     * @param TaskServiceInterface $taskService
     */
    public function __construct(ClientServiceInterface $clientService, WorkorderServiceInterface $workorderService, InvoiceServiceInterface $invoiceService, TaskServiceInterface $taskService)
    {
        $this->clientService = $clientService;
        
        $this->workorderService = $workorderService;
        
        $this->invoiceService = $invoiceService;
        
        $this->taskService = $taskService;
    }

    /**
     * 
     * {@inheritDoc}
     * @see \Zend\Mvc\Controller\AbstractActionController::indexAction()
     */
    public function indexAction()
    {
        $id = $this->params()->fromRoute('clientId');
        
        $clientEntity = $this->clientService->get($id);
        
        if (! $clientEntity) {
            
        }
        
        $this->layout()->setVariable('clientId', $id);
        
        $this->layout()->setVariable('pageTitle', 'View Client');
        
        $this->layout()->setVariable('pageSubTitle', $clientEntity->getClientName());
        
        $this->setHeadTitle($clientEntity->getClientName());
        
        $filter = array(
            'clientId' => $id,
            'workorderStatus' => 'Active'
        );
        
        $workorderEntitys = $this->workorderService->getAll($filter);
        
        $workorderTotalCount = $this->workorderService->getClientTotalCount($id, 'Closed');
        
        $workorderLaborTotal = $this->workorderService->getClientTotalLabor($id);
        
        $workorderPartTotal = $this->workorderService->getClientTotalPart($id);
        
        $workorderRevenuTotal = $workorderLaborTotal + $workorderPartTotal;
        
        // invoice
        $filter = array(
            'clientId' => $id,
            'invoiceStatus' => 'Un-Paid'
        );
        
        $invoiceEntitys = $this->invoiceService->getAll($filter);
        
        // task
        $filter = array(
            'clientId' => $id,
            'taskStatus' => 'Active'
        );
        
        $taskEntitys = $this->taskService->getAll($filter);
        
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
            'taskEntitys' => $taskEntitys
            
        ));
    }
}
