<?php
namespace User\Controller;

use Application\Controller\BaseController;
use Zend\View\Model\ViewModel;

class ProfileController extends BaseController
{
    public function indexAction()
    {
        
        $this->layout()->setVariable('activeMenuItem', 'user');
        
        $this->layout()->setVariable('activeSubMenuItem', 'user-profile');

        return new ViewModel();
    }
}

?>