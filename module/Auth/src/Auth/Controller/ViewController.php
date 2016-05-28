<?php
namespace Auth\Controller;

use Application\Controller\BaseController;
use Auth\Service\AuthServiceInterface;
use Zend\View\Model\ViewModel;

class ViewController extends BaseController
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
    
        $this->layout()->setVariable('pageSubTitle', 'View');
    
        $this->layout()->setVariable('activeMenuItem', 'admin');
    
        $this->layout()->setVariable('activeSubMenuItem', 'auth-index');
    
        $id = $this->params()->fromRoute('authId');
        
        $authEntity = $this->authService->get($id);
        
        if(! $authEntity) {
            $this->flashmessenger()->addErrorMessage('Unable to find the auth ' . $id);
            
            return $this->redirect()->toRoute('auth-index');
        }
        
        
        return new ViewModel(array(
            'authEntity' => $authEntity
        ));
    }
}