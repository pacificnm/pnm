<?php
namespace Auth\Controller;

use Application\Controller\BaseController;
use Auth\Service\AuthServiceInterface;
use Zend\View\Model\ViewModel;

class CreateController extends BaseController
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
     * {@inheritDoc}
     * @see \Zend\Mvc\Controller\AbstractActionController::indexAction()
     */
    public function indexAction()
    {
        $this->layout()->setVariable('pageTitle', 'Auth');
    
        $this->layout()->setVariable('pageSubTitle', 'Create');
    
        $this->layout()->setVariable('activeMenuItem', 'admin');
    
        $this->layout()->setVariable('activeSubMenuItem', 'auth-index');
        
        $userId = $this->params()->fromQuery('userId');
        
        $employeeId = $this->params()->fromQuery('employeeId');
        
        if(! $userId && ! $employeeId) {
            $this->flashmessenger()->addErrorMessage('Missing identifying record. To create a new Auth you must do it from the employee module or the user module');
            
            return $this->redirect()->toRoute('auth-index');
        }
        
        return new ViewModel();
    }
    
}
