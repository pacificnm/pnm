<?php
namespace Admin\Controller;

use Application\Controller\BaseController;
use Zend\View\Model\ViewModel;

class IndexController extends BaseController
{
    
    public function indexAction()
    {
        $this->layout()->setVariable('pageTitle', 'Admin');
        
        $this->layout()->setVariable('pageSubTitle', 'Home');
        
        
        return new ViewModel();
    }
}
