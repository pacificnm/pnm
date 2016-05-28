<?php
namespace Admin\View\Helper;

use Zend\View\Helper\AbstractHelper;

class AdminAsideMenu extends AbstractHelper
{
    /**
     * 
     */
    public function __invoke()
    {
        $view = $this->getView();
    
        $partialHelper = $view->plugin('partial');
    
        // set partial script
        return $partialHelper('partials/admin-aside-menu.phtml');
    }
}