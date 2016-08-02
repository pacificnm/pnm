<?php
namespace User\View\Helper;


use Zend\View\Helper\AbstractHelper;

class UserAsideMenu extends AbstractHelper
{

    public function __invoke()
    {
        $view = $this->getView();
        
        $partialHelper = $view->plugin('partial');
        
        
        
        // set partial script
        return $partialHelper('partials/user-aside-menu.phtml');
    }
}