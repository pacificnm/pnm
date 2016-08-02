<?php
namespace Auth\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Authentication\AuthenticationService;
use Zend\Authentication\Result;
use Zend\Http\Request;
use Zend\Http\Client;
use Zend\Stdlib\Parameters;
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
                    // successful sign in
                    case Result::SUCCESS:
                        // get entity from result
                        $authEntity = $result->getIdentity();
                        
                        // update entity with ip and time
                        $authEntity->setAuthLastLogin(time());
                        
                        $authEntity->setAuthLastIp($_SERVER['REMOTE_ADDR']);
                        
                        $authEntity = $this->service->save($authEntity);
                        
                        $oauthIdentity = $this->getOauth($authEntity->getAuthEmail(), $postData->authPassword);
                                                
                        // join either employeeEntity or userEntity
                        if ($authEntity->getEmployeeId() > 0) {
                            
                            $employeeEntity = $this->employeeService->get($authEntity->getEmployeeId());
                            
                            // set employee entity
                            $authEntity->setEmployeeEntity($employeeEntity);
                            
                            // add oauth for api services.
                            $authEntity->setAccessToken($oauthIdentity['access_token']);
                            
                            $authEntity->setRefreshToken($oauthIdentity['refresh_token']);
                            
                            //$authEntity->setExpiresIn($oauthIdentity->expires_in);
                            
                            $storage = $this->authService->getStorage();
                            
                            $storage->write($authEntity);
                            
                            $this->flashmessenger()->addSuccessMessage('Welcome back ' . $authEntity->getAuthName());
                            
                            return $this->redirect()->toRoute('employee-profile');
                        } else {
                            $userEntity = $this->userService->get($authEntity->getUser());
                            
                            $authEntity->setUserEntity($userEntity);
                            
                            $authEntity->setEmployeeEntity($employeeEntity);
                            
                            // add oauth for api services.
                            $authEntity->setAccessToken($oauthIdentity['access_token']);
                            
                            $authEntity->setRefreshToken($oauthIdentity['refresh_token']);
                            
                            $authEntity->setExpiresIn($oauthIdentity->expires_in);
                            
                            $storage = $this->authService->getStorage();
                            
                            $storage->write($authEntity);
                            
                            $this->flashmessenger()->addSuccessMessage('Welcome back ' . $authEntity->getAuthName());
                            
                            return $this->redirect()->toRoute('user-profile');
                        }
                        
                        break;
                    default:
                        $this->signInForm->get('authEmail')->setMessages(array(
                            $result->getIdentity()
                        ));
                        break;
                }
            }
        }
        
        return new ViewModel(array(
            'form' => $this->signInForm
        ));
    }

    protected function getOauth($username, $password)
    {
        
        $request = new Request();
        
        $request->getHeaders()->addHeaders(array(
            'Content-Type' => 'application/x-www-form-urlencoded; charset=UTF-8'
        ));
        
        
        $request->setUri('http://'.$_SERVER['SERVER_NAME'].'/oauth');
        
        $request->setMethod('POST');
        
        $request->setPost(new Parameters(array(
            'grant_type' => 'password',
            'client_id' => 'pnm',
            'username' => $username,
            'password' => $password
        )));
        
        $client = new Client();
        
        $response = $client->dispatch($request);
        
        $data = json_decode($response->getBody(), true);
        
        return $data;
    }
}

