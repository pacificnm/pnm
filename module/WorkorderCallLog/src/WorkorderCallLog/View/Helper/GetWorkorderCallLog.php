<?php
namespace WorkorderCallLog\View\Helper;

use Zend\View\Helper\AbstractHelper;
use WorkorderCallLog\Service\WorkorderCallLogServiceInterface;

class GetWorkorderCallLog extends AbstractHelper
{
    /**
     * 
     * @var WorkorderCallLogServiceInterface
     */
    protected $workorderCallLogService;
    
    /**
     * 
     * @param number $workorderId
     */
    public function __invoke($workorderId)
    {
        
        $view = $this->getView();
        
        $partialHelper = $view->plugin('partial');
        
        $data  = new \stdClass();
        
        $workorderCallLogEntitys = $this->workorderCallLogService->getAll(array('workorderId' => $workorderId));
        
        $data->workorderCallLogEntitys = $workorderCallLogEntitys;
        
        return $partialHelper('partials/get-workorder-call-log.phtml', $data);
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