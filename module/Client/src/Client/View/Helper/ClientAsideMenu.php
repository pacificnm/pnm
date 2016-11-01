<?php
namespace Client\View\Helper;

use Zend\View\Helper\AbstractHelper;

class ClientAsideMenu extends AbstractHelper
{
    public function __invoke()
    {
        $view = $this->getView();
    
        $partialHelper = $view->plugin('partial');
    
        // set partial script
        return $partialHelper('partials/client-aside-menu.phtml');
    }
}