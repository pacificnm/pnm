<?php
namespace Task\View\Helper;

use Zend\View\Helper\AbstractHelper;

class NavBarTask extends AbstractHelper
{
    public function __invoke()
    {
        $view = $this->getView();
    
        $partialHelper = $view->plugin('partial');
    
        return $partialHelper('partials/nav-bar-task.phtml');
    }
}
