<?php
namespace Message\View\Helper;

use Zend\View\Helper\AbstractHelper;

class NavBarMessage extends AbstractHelper
{
    public function __invoke()
    {
        $view = $this->getView();
        
        $partialHelper = $view->plugin('partial');
        
        return $partialHelper('partials/nav-bar-message.phtml');
    }
}
