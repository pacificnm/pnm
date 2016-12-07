<?php
namespace ReportProfit\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use ReportProfit\Service\ReportProfitServiceInterface;
use Zend\Console\Adapter\AdapterInterface as Console;
use Zend\Console\Request as ConsoleRequest;
use Zend\Log\Logger;
use Zend\Log\Writer\Stream;
use RuntimeException;
use Workorder\Service\WorkorderServiceInterface;
use ReportProfit\Entity\ReportProfitEntity;
use VendorBill\Service\BillServiceInterface;

class ConsoleController extends AbstractActionController
{

    protected $service;
    
    protected $workorderService;
    
    protected $billService;
    
    protected $logService;
    
    protected $writerService;
    
    public function __construct(ReportProfitServiceInterface $service, WorkorderServiceInterface $workorderService, BillServiceInterface $billService)
    {
        $this->service = $service;
        
        $this->workorderService = $workorderService;
        
        $this->billService = $billService;
        
        $this->logService = new Logger();
        
        $this->writerService = new Stream('./data/log/' . date('Y-m-d') . '-profit-report.log');
        
        $this->logService->addWriter($this->writerService);
    }
    
    /**
     * 
     * {@inheritDoc}
     * @see \Zend\Mvc\Controller\AbstractActionController::indexAction()
     */
    public function indexAction()
    {
        // load request
        $request = $this->getRequest();
        
        // validate we are in a console
        if (! $request instanceof ConsoleRequest) {
            throw new RuntimeException('Cannot handle request of type ' . get_class($request));
        }
        
        // load console
        $console = $this->getServiceLocator()->get('console');
        
        $start = date('m/d/Y h:i a', time());
        
        $console->write("Start profit report at {$start}\n", 3);
        
        $this->logService->info("Start profit report at {$start}");
        
        $year = date("Y", time());
        
        for ($month = 1; $month <= 12; $month++) {
            // labor
            $reportProfitLabor = 0;
            
            // parts
            $reportProfitParts = 0;
            
            // expense
            $reportProfitExpense = 0;
            
            // get number of days in a month and year
            $days = date("t", mktime(0, 0, 0, $month, 1, $year));
            
            $startTime = mktime(0, 0, 0, $month, 1, $year);
            
            $endTime = mktime(23, 59, 59, $month, $days, $year);
            
            $reportProfitEntity = new ReportProfitEntity();
            
            $entitys = $this->workorderService->getByDateRange($startTime, $endTime, 'Closed', false);
            
            // loop though workorders and count them up
            foreach($entitys as $entity) {
                $reportProfitLabor = $reportProfitLabor + $entity->getWorkorderLabor();
                
                $reportProfitParts = $reportProfitParts + $entity->getWorkorderParts();
            }
            
            // get bill total for the month
            $reportProfitExpense = $this->billService->getTotalForMonth($startTime, $endTime);
            
            $checkEntity = $this->service->getMonth($month, $year);
            
            if($checkEntity) {
                $reportProfitEntity->setReportProfitId($checkEntity->getReportProfitId());
            }
            
            $reportProfitEntity->setReportProfitLabor($reportProfitLabor);
            
            $reportProfitEntity->setReportProfitParts($reportProfitParts);
            
            $reportProfitEntity->setReportProfitMonth($month);
            
            $reportProfitEntity->setReportProfitYear($year);
            
            $reportProfitEntity->setReportProfitUpdated(time());
            
            $reportProfitEntity->setReportProfitExpense($reportProfitExpense);
            
            $this->service->save($reportProfitEntity);
        }
        
        // done
        $end = date('m/d/Y h:i a', time());
        
        $console->write("Comleted profit report at {$end}\n", 3);
        
        $this->logService->info("Comleted profit report at {$end}");
    }
}

