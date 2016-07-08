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
use WorkorderTime\Service\TimeServiceInterface;

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
     * @var TimeServiceInterface
     */
    protected $timeService;
    
    /**
     * 
     * @param ClientServiceInterface $clientService
     * @param WorkorderServiceInterface $workorderService
     * @param InvoiceServiceInterface $invoiceService
     * @param TaskServiceInterface $taskService
     * @param LocationServiceInterface $locationService
     * @param UserServiceInterface $userService
     * @param TimeServiceInterface $timeService
     */
    public function __construct(ClientServiceInterface $clientService, WorkorderServiceInterface $workorderService, InvoiceServiceInterface $invoiceService, TaskServiceInterface $taskService, LocationServiceInterface $locationService, UserServiceInterface $userService, TimeServiceInterface $timeService)
    {
        $this->clientService = $clientService;
        
        $this->workorderService = $workorderService;
        
        $this->invoiceService = $invoiceService;
        
        $this->taskService = $taskService;
        
        $this->locationService = $locationService;
        
        $this->userService = $userService;
        
        $this->timeService = $timeService;
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
        
        // start time
        $start = mktime(0, 0, 0, 1, 1, date("Y"));
        
        // end time
        $end = mktime(23, 59, 59, 12, 31, date("Y"));
        
        // get chart data
        //$timeEntitys = $this->timeService->getTotalsForYear($start, $end, $id);
        
        $chartEntitys = $this->invoiceService->getTotalsFormYear($start, $end, 'Paid', $id);
        
        
        $data = array();
        
        $data2 = array();
        
        for($x = 1; $x <= 12; $x++) {
            $data[$x] = 0;
        }
        
        foreach($chartEntitys as $chartEntity) {
            $month = intval(date("m", $chartEntity->invoice_date));
            $data2[$month] = $chartEntity->invoice_total_month;
        }
        
        $dataSet = array_replace($data, $data2);
        
               
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
            'userEntity' => $userEntity,
            'dataSet' => $dataSet
        ));
    }
}
