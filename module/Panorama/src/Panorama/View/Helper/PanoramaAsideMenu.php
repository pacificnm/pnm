<?php
namespace Panorama\View\Helper;

use Zend\View\Helper\AbstractHelper;


class PanoramaAsideMenu extends AbstractHelper
{
    public function __invoke()
    {
    
        $view = $this->getView();
    
        $partialHelper = $view->plugin('partial');
    
        // set partial script
        return $partialHelper('partials/panorama-aside-menu');
    }
}

?>