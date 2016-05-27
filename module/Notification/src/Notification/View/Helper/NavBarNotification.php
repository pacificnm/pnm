<?php
namespace Notification\View\Helper;
use Zend\View\Helper\AbstractHelper;

class NavBarNotification extends AbstractHelper
{
    public function __invoke()
    {
        $view = $this->getView();
    
        $partialHelper = $view->plugin('partial');
    
        return $partialHelper('partials/nav-bar-notification.phtml');
    }
}