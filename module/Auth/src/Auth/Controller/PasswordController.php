<?php
namespace Auth\Controller;

use Application\Controller\BaseController;
use Auth\Service\AuthServiceInterface;
use Zend\View\Model\ViewModel;
use Auth\Form\PasswordForm;
use Zend\Crypt\Password\Bcrypt;

class PasswordController extends BaseController
{
    /**
     *
     * @var AuthServiceInterface
     */
    protected $authService;

    /**
     * 
     * @var PasswordForm
     */
    protected $passwordForm;
    
    /**
     * 
     * @param AuthServiceInterface $authService
     * @param PasswordForm $passwordForm
     */
    public function __construct(AuthServiceInterface $authService, PasswordForm $passwordForm)
    {
        $this->authService = $authService;
        
        $this->passwordForm = $passwordForm;
    }
    
    
    /**
     *
     * {@inheritDoc}
     *
     * @see \Zend\Mvc\Controller\AbstractActionController::indexAction()
     */
    public function indexAction()
    {
        $this->layout()->setVariable('pageTitle', 'Auth');
    
        $this->layout()->setVariable('pageSubTitle', 'Reset Password');
    
        $this->layout()->setVariable('activeMenuItem', 'admin');
    
        $this->layout()->setVariable('activeSubMenuItem', 'auth-index');
    
        $authId = $this->params()->fromRoute('authId');
    
        $authEntity = $this->authService->get($authId);
    
        if(! $authEntity) {
            $this->flashmessenger()->addErrorMessage('Unable to find the auth ' . $authId);
            
            return $this->redirect()->toRoute('auth-index');
        }
        
        $this->passwordForm->bind($authEntity);
    
        $request = $this->getRequest();
    
        // if we have a post
        if ($request->isPost()) {
            // get post
            $postData = $request->getPost();
    
            $this->passwordForm->setData($postData);
    
            // if we are valid
            if ($this->passwordForm->isValid()) {
                $authEntity = $this->passwordForm->getData();
    
                $bcrypt = new Bcrypt();
                
                $authEntity->setAuthPassword($bcrypt->create($authEntity->getAuthPassword()));
                
                $this->authService->save($authEntity);
    
                $this->flashmessenger()->addSuccessMessage('The password was reset.');
    
                return $this->redirect()->toRoute('auth-view', array(
                    'authId' => $authEntity->getAuthId()
                ));
            }
        }
    
        return new ViewModel(array(
            'form' => $this->passwordForm
        ));
    }
}
