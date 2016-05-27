<?php
namespace Auth\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Authentication\AuthenticationService;
use Zend\Authentication\Result;
use Auth\Adapter\AuthAdapter;
use Auth\Form\SignInForm;
use Auth\Service\AuthServiceInterface;
use Employee\Service\EmployeeServiceInterface;
use User\Service\UserServiceInterface;

class SignInController extends AbstractActionController
{

    /**
     *
     * @var AuthenticationService
     */
    protected $authService;

    /**
     * 
     * @var AuthServiceInterface
     */
    protected $service;
    
    /**
     *
     * @var AuthAdapter
     */
    protected $authAdapter;

    /**
     *
     * @var SignInForm
     */
    protected $signInForm;

    /**
     * 
     * @var EmployeeServiceInterface
     */
    protected $employeeService;
    
    /**
     * 
     * @var UserServiceInterface
     */
    protected $userService;
    /**
     * 
     * @param AuthenticationService $authService
     * @param AuthAdapter $authAdapter
     * @param AuthServiceInterface $service
     * @param EmployeeServiceInterface $employeeService
     * @param UserServiceInterface $userService
     * @param SignInForm $signInForm
     */
    public function __construct(AuthenticationService $authService, AuthAdapter $authAdapter, AuthServiceInterface $service, EmployeeServiceInterface $employeeService, UserServiceInterface $userService, SignInForm $signInForm)
    {
        $this->signInForm = $signInForm;
        
        $this->authAdapter = $authAdapter;
        
        $this->authService = $authService;
        
        $this->service = $service;
        
        $this->employeeService = $employeeService;
        
        $this->userService = $userService;
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \Zend\Mvc\Controller\AbstractActionController::indexAction()
     */
    public function indexAction()
    {
        $this->layout('/layout/sign-in.phtml');
        
        // get request object
        $request = $this->getRequest();
        
        // if we have a post
        if ($request->isPost()) {
            // get post
            $postData = $request->getPost();
            
            // set data
            $this->signInForm->setData($postData);
            
            // if we are valid
            if ($this->signInForm->isValid()) {
                
                $authEntity = $this->signInForm->getData();
                               
                $this->authAdapter->setIdentity($authEntity->getAuthEmail());
                
                $this->authAdapter->setCredential($authEntity->getAuthPassword());
                
                $result = $this->authService->authenticate($this->authAdapter);
               
                switch ($result->getCode()) {
                    case Result::SUCCESS:
                        // get entity from result
                        $authEntity = $result->getIdentity();
                        
                        // update entity with ip and time
                        $authEntity->setAuthLastLogin(time());
                        $authEntity->setAuthLastIp($_SERVER['REMOTE_ADDR']);
                        
                        $authEntity = $this->service->save($authEntity);
                        
                        // join either employeeEntity or userEntity
                        if($authEntity->getEmployeeId() > 0) {
                            $employeeEntity = $this->employeeService->get($authEntity->getEmployeeId());
                            
                            // set employee entity
                            $authEntity->setEmployeeEntity($employeeEntity);
                            
                            $storage = $this->authService->getStorage();
                            $storage->write($authEntity);
                            
                            $this->flashmessenger()->addSuccessMessage('Welcome back ' . $authEntity->getAuthName());
                            
                            return $this->redirect()->toRoute('home');
                        } else {
                            $userEntity = $this->userService->get($authEntity->getUserId());
                            
                            $authEntity->setUserEntity($userEntity);
                            
                            $authEntity->setEmployeeEntity($employeeEntity);
                            
                            $storage = $this->authService->getStorage();
                            $storage->write($authEntity);
                            
                            $this->flashmessenger()->addSuccessMessage('Welcome back ' . $authEntity->getAuthName());
                            
                            return $this->redirect()->toRoute('home');
                        }
                        
                    break;
                    default:
                        $this->signInForm->get('authEmail')->setMessages(array($result->getIdentity()));
                    break;
                }
            }
        }
        
        return new ViewModel(array(
            'form' => $this->signInForm
        ));
    }
}

