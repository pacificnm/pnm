<?php
namespace CallLog\View\Helper;

use Zend\View\Helper\AbstractHelper;
use CallLog\Service\LogServiceInterface;

class GetEmployeeCallLogs extends AbstractHelper
{

    /**
     * 
     * @var LogServiceInterface
     */
    protected $logService;

    /**
     * 
     * @param LogServiceInterface $logService
     */
    public function __construct(LogServiceInterface $logService)
    {
        $this->logService = $logService;
    }

    /**
     * 
     * @param number $employeeId
     */
    public function __invoke($employeeId)
    {
        $view = $this->getView();
        
        $partialHelper = $view->plugin('partial');
        
        $data = new \stdClass();
        
        $logEntitys = $this->logService->getEmployeeCallLogs($employeeId);
        
        $data->logEntitys = $logEntitys;
        
        return $partialHelper('partials/get-employee-call-logs.phtml', $data);
    }
}