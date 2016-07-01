<?php
namespace Employee\View\Helper;

use Zend\View\Helper\AbstractHelper;
use ClientFavorite\Service\FavoriteServiceInterface;

class EmployeeAsideMenu extends AbstractHelper
{    
    /**
     * 
     * @param number $clientId
     * @param unknown $activeItem
     */
    public function __invoke()
    {
       
        $view = $this->getView();
    
               
        $partialHelper = $view->plugin('partial');
    
        // set partial script
        return $partialHelper('partials/employee-aside-menu.phtml');
    }
}
