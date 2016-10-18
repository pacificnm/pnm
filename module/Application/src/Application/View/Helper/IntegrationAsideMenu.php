<?php
namespace Application\View\Helper;

use Zend\View\Helper\AbstractHelper;

class IntegrationAsideMenu extends AbstractHelper
{
  
    
    public function __invoke()
    {
        
        $view = $this->getView();
        
        $partialHelper = $view->plugin('partial');
        
        // set partial script
        return $partialHelper('partials/integration-aside-menu');
    }
}

?>