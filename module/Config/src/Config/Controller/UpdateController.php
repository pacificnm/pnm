<?php
namespace Config\Controller;

use Application\Controller\BaseController;
use Zend\View\Model\ViewModel;

class UpdateController extends BaseController
{
    /**
     * 
     * {@inheritDoc}
     * @see \Zend\Mvc\Controller\AbstractActionController::indexAction()
     */
    public function indexAction()
    {
        $this->layout()->setVariable('pageTitle', 'Edit Config');
    
        $this->layout()->setVariable('pageSubTitle', '');
    
        $this->layout()->setVariable('activeMenuItem', 'admin');
    
        $this->layout()->setVariable('activeSubMenuItem', 'config-index');
        
        return new ViewModel();
    }
}