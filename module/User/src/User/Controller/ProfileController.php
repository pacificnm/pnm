<?php
namespace User\Controller;

use Application\Controller\BaseController;
use Zend\View\Model\ViewModel;
use User\Service\UserServiceInterface;

class ProfileController extends BaseController
{
    protected $userService;
    
    public function __construct(UserServiceInterface $userService)
    {
        $this->userService = $userService;
    }
    
    public function indexAction()
    {
        $userEntity = $this->userService->get($this->identity()->getUserId());

       
        
        // set layout up
        $this->layout()->setVariable('pageTitle', 'My Profile');
        
        $this->layout()->setVariable('pageSubTitle', $this->identity()
            ->getAuthName());
        
        $this->layout()->setVariable('activeMenuItem', 'user');
        
        $this->layout()->setVariable('activeSubMenuItem', 'user-profile');

        return new ViewModel(array(
            'userEntity' => $userEntity
        ));
    }
}