<?php
namespace Message\View\Helper;

use Zend\View\Helper\AbstractHelper;

class GetEmployeeMessages extends AbstractHelper
{
    public function __construct()
    {
        
    }
    
    /**
     * 
     * @param unknown $employeeId
     */
    public function __invoke($employeeId)
    {
        $view = $this->getView();
        
        $partialHelper = $view->plugin('partial');
        
        $data = new \stdClass();
        
        return $partialHelper('partials/get-employee-messages.phtml', $data);
    }
}