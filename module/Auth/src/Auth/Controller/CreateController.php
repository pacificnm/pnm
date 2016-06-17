<?php
namespace Auth\Controller;

use Application\Controller\BaseController;
use Auth\Service\AuthServiceInterface;
use Zend\View\Model\ViewModel;
use Auth\Form\AuthCreateForm;
use User\Service\UserServiceInterface;
use Zend\Crypt\Password\Bcrypt;

class CreateController extends BaseController
{

    /**
     *
     * @var AuthServiceInterface
     */
    protected $authService;

    /**
     *
     * @var UserServiceInterface
     */
    protected $userService;

    /**
     *
     * @var AuthCreateForm
     */
    protected $authForm;

    /**
     *
     * @param AuthServiceInterface $authService            
     * @param UserServiceInterface $userService            
     * @param AuthCreateForm $authForm            
     */
    public function __construct(AuthServiceInterface $authService, UserServiceInterface $userService, AuthCreateForm $authForm)
    {
        $this->authService = $authService;
        
        $this->userService = $userService;
        
        $this->authForm = $authForm;
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \Zend\Mvc\Controller\AbstractActionController::indexAction()
     */
    public function indexAction()
    {
        $userId = $this->params()->fromQuery('userId');
        
        $employeeId = $this->params()->fromQuery('employeeId');
        
        if (! $userId && ! $employeeId) {
            $this->flashmessenger()->addErrorMessage('Missing identifying record. To create a new Auth you must do it from the employee module or the user module');
            
            return $this->redirect()->toRoute('auth-index');
        }
        
        if ($userId) {
            $userEntity = $this->userService->get($userId);
        
            $this->authForm->get('authEmail')->setValue($userEntity->getUserEmail());
        
            $this->authForm->get('authName')->setValue($userEntity->getUserNameFirst() . ' ' . $userEntity->getUserNameLast());
        
            $this->authForm->get('authRole')->setValue('user');
        
            $this->authForm->get('authRole')->setAttribute('disabled', true);
        
            $this->authForm->get('authType')->setValue('User');
        
            $this->authForm->get('authType')->setAttribute('disabled', true);
        
            $this->authForm->get('userId')->setValue($userId);
        
            $this->authForm->get('employeeId')->setValue(0);
        
            $this->authForm->get('authLastLogin')->setValue(0);
        
            $this->authForm->get('authLastIp')->setValue(0);
        
            $this->authForm->get('authId')->setValue(0);
        }
        
        
        $request = $this->getRequest();
        
        // if we have a post
        if ($request->isPost()) {
            // get post
            $postData = $request->getPost();
            
            if ($userId) {
                $postData->authType = 'User';
                
                $postData->authRole = 'user';
            }
            
            $this->authForm->setData($postData);
            
            if ($this->authForm->isValid()) {
                
                $bcrypt = new Bcrypt();
                
                $authEntity = $this->authForm->getData();
                
                $authEntity->setAuthType($postData->authType);
                
                $authEntity->setAuthRole($postData->authRole);
                
                $authEntity->setAuthPassword($bcrypt->create($authEntity->getAuthPassword()));
                
                $this->authService->save($authEntity);
                
                if ($userId) {
                    $this->flashmessenger()->addSuccessMessage('User has access granted.');
                    
                    return $this->redirect()->toRoute('user-view', array(
                        'clientId' => $userEntity->getUserId(),
                        'userId' => $userId
                    ));
                }
                
            }
        }
        
        
        
        $this->layout()->setVariable('pageTitle', 'Auth');
        
        $this->layout()->setVariable('pageSubTitle', 'Create');
        
        $this->layout()->setVariable('activeMenuItem', 'admin');
        
        $this->layout()->setVariable('activeSubMenuItem', 'auth-index');
        
        return new ViewModel(array(
            'form' => $this->authForm
        ));
    }
}
