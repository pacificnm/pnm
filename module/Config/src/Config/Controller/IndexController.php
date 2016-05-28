<?php
namespace Config\Controller;

use Application\Controller\BaseController;
use Zend\View\Model\ViewModel;

class IndexController extends BaseController
{
    /**
     * 
     * {@inheritDoc}
     * @see \Zend\Mvc\Controller\AbstractActionController::indexAction()
     */
    public function indexAction()
    {
        $this->layout()->setVariable('pageTitle', 'Config');
        
        $this->layout()->setVariable('pageSubTitle', '');
        
        $this->layout()->setVariable('activeMenuItem', 'admin');
        
        return new ViewModel();
    }
}
