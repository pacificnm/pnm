<?php
namespace Account\View\Helper;

use Zend\View\Helper\AbstractHelper;

class AccountAsideMenu extends AbstractHelper
{

    /**
     */
    public function __invoke()
    {
        $view = $this->getView();
        
        $partialHelper = $view->plugin('partial');
        
        // set partial script
        return $partialHelper('partials/account-aside-menu.phtml');
    }
}