<?php
namespace Employee\View\Helper;

use Zend\View\Helper\AbstractHelper;
use Employee\Service\EmployeeServiceInterface;
class GetEmployeeDetails extends AbstractHelper
{
    /**
     * 
     * @var EmployeeServiceInterface
     */
    protected $employeeService;
    
    /**
     * 
     * @param EmployeeServiceInterface $employeeService
     */
    public function __construct(EmployeeServiceInterface $employeeService)
    {
        $this->employeeService = $employeeService;
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
        
        $employeeEntity = $this->employeeService->get($employeeId);
        
        $data->employeeEntity = $employeeEntity;
        
        return $partialHelper('partials/get-employee-details.phtml', $data);
    }
}