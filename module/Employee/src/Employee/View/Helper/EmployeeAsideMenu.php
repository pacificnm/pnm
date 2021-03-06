<?php
namespace Employee\View\Helper;

use Zend\View\Helper\AbstractHelper;

class EmployeeAsideMenu extends AbstractHelper
{

    /**
     * 
     */
    public function __invoke()
    {
        $view = $this->getView();
        
        $partialHelper = $view->plugin('partial');
        
        // set partial script
        return $partialHelper('partials/employee-aside-menu.phtml');
    }
}
