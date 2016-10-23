<?php
namespace WorkorderCallLog\View\Helper;

use Zend\View\Helper\AbstractHelper;
use WorkorderCallLog\Service\WorkorderCallLogServiceInterface;

class GetCallLogWorkorder extends AbstractHelper
{
    /**
     * 
     * @var WorkorderCallLogServiceInterface
     */
    protected $workorderCallLogService;
    
    /**
     * 
     * @param number $callLogId
     */
    public function __invoke($callLogId)
    {
        $view = $this->getView();
        
        $partialHelper = $view->plugin('partial');
        
        $data  = new \stdClass();
        
        $workorderCallLogEntitys = $this->workorderCallLogService->getCallLogWorkorders($callLogId);
        
        $data->workorderCallLogEntitys = $workorderCallLogEntitys;
        
        return $partialHelper('partials/get-call-log-workorder.phtml', $data);
    }
    
    /**
     * 
     * @param WorkorderCallLogServiceInterface $workorderCallLogService
     */
    public function __construct(WorkorderCallLogServiceInterface $workorderCallLogService)
    {
        $this->workorderCallLogService = $workorderCallLogService;
    }
}

?>