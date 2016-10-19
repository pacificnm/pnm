<?php
namespace Workorder\View\Helper;

use Zend\View\Helper\AbstractHelper;
use WorkorderEmployee\Service\WorkorderEmployeeServiceInterface;

class GetEmployeeWorkorders extends AbstractHelper
{

    /**
     * 
     * @var WorkorderServiceInterface
     */
    protected $workorderService;
    
    /**
     * 
     * @param WorkorderServiceInterface $workorderService
     */
    public function __construct(WorkorderEmployeeServiceInterface $workorderService)
    {
        $this->workorderService = $workorderService;
    }

    /**
     * 
     * @param unknown $employeeId
     * @param string $workorderStatus
     */
    public function __invoke($employeeId, $workorderStatus = 'Active')
    {
        $view = $this->getView();
        
        $partialHelper = $view->plugin('partial');
        
        $data = new \stdClass();
        
        $workorderEntitys = $this->workorderService->getEmployeeWorkorders($employeeId, $workorderStatus);
        
        $data->workorderEntitys = $workorderEntitys;
        
        return $partialHelper('partials/get-employee-workorders.phtml', $data);
    }
}