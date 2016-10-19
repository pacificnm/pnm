<?php
namespace Panorama\Controller;

use Application\Controller\BaseController;
use Panorama\Service\MspServiceInterface;
use Zend\View\Model\ViewModel;
use Panorama\Service\UserServiceInterface;

class UserController extends BaseController
{
    /**
     *
     * @var MspServiceInterface
     */
    protected $mspService;
    
    protected $userService;
    
    public function __construct(MspServiceInterface $mspService, UserServiceInterface $userService)
    {
        $this->mspService = $mspService;
        
        $this->userService = $userService;
        
        
    }
    
    public function indexAction()
    {
        $cid = $this->params('cid');
        
        $mspEntity = $this->mspService->getClient($cid);
        
        $paginator = $this->userService->getUsers($cid);
        
        return new ViewModel(array(
            'mspEntity' => $mspEntity,
            'paginator' => $paginator
        ));
    }
}