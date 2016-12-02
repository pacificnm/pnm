<?php
/**
 * Pacific NM (https://www.pacificnm.com)
 *
 * @link      https://github.com/pacificnm/pnm for the canonical source repository
 * @copyright Copyright (c) 20011-2016 Pacific NM USA Inc. (https://www.pacificnm.com)
 * @license   https://www.pacificnm.com/license/new-bsd New BSD License
 */
namespace Account\Controller;

use Application\Controller\BaseController;
use Zend\View\Model\ViewModel;
use Workorder\Service\WorkorderServiceInterface;
use Invoice\Service\InvoiceServiceInterface;
use WorkorderTime\Service\TimeServiceInterface;
use WorkorderPart\Service\PartServiceInterface;
use VendorBill\Service\BillServiceInterface;
use Account\Service\AccountServiceInterface;
use Account\Service\AccountService;

/**
 *
 * @author jaimie <pacificnm@gmail.com>s
 * @version 2.5.0
 *         
 */
class HomeController extends BaseController
{

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
     * @var TimeServiceInterface
     */
    protected $timeService;

    /**
     *
     * @var PartServiceInterface
     */
    protected $partService;

    /**
     *
     * @var BillServiceInterface
     */
    protected $billService;

    /**
     *
     * @var AccountService
     */
    protected $accountService;

    /**
     *
     * @param WorkorderServiceInterface $workorderService            
     * @param InvoiceServiceInterface $invoiceService            
     * @param TimeServiceInterface $timeService            
     * @param PartServiceInterface $partService            
     * @param BillServiceInterface $billService            
     * @param AccountServiceInterface $accountService            
     */
    public function __construct(WorkorderServiceInterface $workorderService, InvoiceServiceInterface $invoiceService, TimeServiceInterface $timeService, PartServiceInterface $partService, BillServiceInterface $billService, AccountServiceInterface $accountService)
    {
        $this->workorderService = $workorderService;
        
        $this->invoiceService = $invoiceService;
        
        $this->timeService = $timeService;
        
        $this->partService = $partService;
        
        $this->billService = $billService;
        
        $this->accountService = $accountService;
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \Zend\Mvc\Controller\AbstractActionController::indexAction()
     */
    public function indexAction()
    {
        // start time
        $start = mktime(0, 0, 0, date("m"), 1, date("Y"));
        
        // end time
        $end = mktime(23, 59, 59, date("m"), date("t"), date("Y"));
        
        $data = array();
        
        $data2 = array();
        
        // get open workorders
        $openWorkorderEntitys = $this->workorderService->getByDateRange(null, $end, 'Active');
        
        // get closed workorders
        $closedWorkorderEntitys = $this->workorderService->getByDateRange($start, $end, 'Closed');
        
        // get un-paid invoices
        $openInvoiceEntitys = $this->invoiceService->getByDateRange(null, $end, 'Un-Paid');
        
        $openInvoiceEntitys->setItemCountPerPage(50);
        
        // get closed invoices
        $closedInvoiceEntitys = $this->invoiceService->getByDateRange($start, $end, 'Paid');
        
        // get total labor
        $totalLabor = $this->timeService->getTotalByDateRange($start, $end);
        
        // get total parts
        $totalParts = $this->partService->getTotalByDateRange($start, $end);
        
        // get due bills
        $billEntitys = $this->billService->getDueBills();
        
        // get accounts
        $accountEntitys = $this->accountService->getNonSystemAccounts();

        for($x = 1; $x <= date("t"); $x++) {
            $data[$x] = 0;
        }

        
        $charEntitys = $this->timeService->getTotalsForMonth($start, $end);
        
        foreach($charEntitys as $charEntity) {
            $day = intval(date("d", $charEntity->workorder_time_in));
            $data2[$day] = $charEntity->workorder_labor_total;
        }
        
        $dataSet = array_replace($data, $data2);
        
        // set up layout
        $this->layout()->setVariable('pageTitle', 'Accounting');
        
        $this->layout()->setVariable('pageSubTitle', 'Home');
        
        $this->layout()->setVariable('activeMenuItem', 'account');
        
        $this->layout()->setVariable('activeSubMenuItem', 'account-home');
        
        // return view model
        return new ViewModel(array(
            'openWorkorderEntitys' => $openWorkorderEntitys,
            'closedWorkorderEntitys' => $closedWorkorderEntitys,
            'openInvoiceEntitys' => $openInvoiceEntitys,
            'closedInvoiceEntitys' => $closedInvoiceEntitys,
            'totalLabor' => $totalLabor,
            'totalParts' => $totalParts,
            'billEntitys' => $billEntitys,
            'accountEntitys' => $accountEntitys,
            'dataSet' => $dataSet
        ));
    }
}
