<?php
namespace Auth\View\Helper;

use Zend\View\Helper\AbstractHelper;
use Auth\Service\AuthServiceInterface;

class GetEmployeeAuthDetails extends AbstractHelper
{

    /**
     * 
     * @var AuthServiceInterface
     */
    protected $authService;

    /**
     * 
     * @param AuthServiceInterface $authService
     */
    public function __construct(AuthServiceInterface $authService)
    {
        $this->authService = $authService;
    }
    
    /**
     *
     * @param AuthServiceInterface $authService            
     */
    public function __invoke($authId)
    {
        $view = $this->getView();
        
        $partialHelper = $view->plugin('partial');
        
        $data = new \stdClass();
        
        $authEntity = $this->authService->get($authId);
        
        $data->authEntity = $authEntity;
        
        return $partialHelper('partials/get-employee-auth-details.phtml', $data);
        
    }

    
}