<?php
namespace Client\Controller;

use Application\Controller\BaseController;
use Zend\View\Model\ViewModel;
use Client\Service\ClientServiceInterface;
use User\Service\UserServiceInterface;
use Location\Service\LocationServiceInterface;
use Phone\Service\PhoneServiceInterface;
use Client\Form\ClientForm;
use Location\Form\LocationForm;
use Phone\Form\PhoneForm;
use User\Form\UserForm;
use Account\Service\AccountService;
use ClientAccount\Service\AccountService as ClientAccountServiceInterface;
use Account\Entity\AccountEntity;

class CreateController extends BaseController
{

    /**
     *
     * @var ClientServiceInterface
     */
    protected $clientService;

    /**
     *
     * @var UserServiceInterface
     */
    protected $userService;

    /**
     *
     * @var LocationServiceInterface
     */
    protected $locationService;

    /**
     *
     * @var PhoneServiceInterface
     */
    protected $phoneService;

    /**
     *
     * @var AccountService
     */
    protected $accountService;

    /**
     *
     * @var \ClientAccount\Service\AccountService
     */
    protected $clientAccountService;

    /**
     *
     * @var ClientForm
     */
    protected $clientForm;

    /**
     *
     * @var LocationForm
     */
    protected $locationForm;

    /**
     *
     * @var PhoneForm
     */
    protected $phoneForm;

    /**
     *
     * @var UserForm
     */
    protected $userForm;

    /**
     *
     * @param ClientServiceInterface $clientService            
     * @param UserServiceInterface $userService            
     * @param LocationServiceInterface $locationService            
     * @param PhoneServiceInterface $phoneService            
     * @param AccountService $accountService            
     * @param ClientAccountServiceInterface $clientAccountService            
     * @param ClientForm $clientForm            
     * @param LocationForm $locationForm            
     * @param PhoneForm $phoneForm            
     * @param UserForm $userForm            
     */
    public function __construct(ClientServiceInterface $clientService, UserServiceInterface $userService, LocationServiceInterface $locationService, PhoneServiceInterface $phoneService, AccountService $accountService, ClientAccountServiceInterface $clientAccountService, ClientForm $clientForm, LocationForm $locationForm, PhoneForm $phoneForm, UserForm $userForm)
    {
        $this->clientService = $clientService;
        
        $this->userService = $userService;
        
        $this->locationService = $locationService;
        
        $this->phoneService = $phoneService;
        
        $this->accountService = $accountService;
        
        $this->clientAccountService = $clientAccountService;
        
        $this->clientForm = $clientForm;
        
        $this->locationForm = $locationForm;
        
        $this->phoneForm = $phoneForm;
        
        $this->userForm = $userForm;
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \Zend\Mvc\Controller\AbstractActionController::indexAction()
     */
    public function indexAction()
    {
        $request = $this->getRequest();
        
        // if we have a post
        if ($request->isPost()) {
            // get post
            $postData = $request->getPost();
            
            // set defaults
            $postData->clientId = 0;
            
            $postData->userId = 0;
            
            $postData->userStatus = 'Active';
            
            $postData->userType = 'Primary';
            
            $postData->locationId = 0;
            
            $postData->locationType = 'Primary';
            
            $postData->locationStatus = 'Active';
            
            $postData->phoneId = 0;
            
            $postData->phoneType = 'Primary';
            
            $this->clientForm->setData($postData);
            
            $this->userForm->setData($postData);
            
            $this->locationForm->setData($postData);
            
            $this->phoneForm->setData($postData);
            
            // if we are valid
            if ($this->clientForm->isValid() && $this->userForm->isValid() && $this->locationForm->isValid() && $this->phoneForm->isValid()) {
                
                $clientEntity = $this->clientForm->getData();
                
                $clientEntity->setClientCreated(time());
                
                $clientEntity = $this->clientService->save($clientEntity);
                
                // location
                $locationEntity = $this->locationForm->getData();
                
                $locationEntity->setClientId($clientEntity->getClientId());
                
                $locationEntity = $this->locationService->save($locationEntity);
                
                // phone enity
                $phoneEntity = $this->phoneForm->getData();
                
                $phoneEntity->setClientId($clientEntity->getClientId());
                
                $phoneEntity->setLocationId($locationEntity->getLocationId());
                
                $this->phoneService->save($phoneEntity);
                
                // user entity
                $userEntity = $this->userForm->getData();
                
                $userEntity->setClientId($clientEntity->getClientId());
                
                $userEntity->setLocationId($locationEntity->getLocationId());
                
                $userEntity = $this->userService->save($userEntity);
                
                
                // create account
                $this->createAccount($clientEntity->getClientId(), $clientEntity->getClientName());
               
                
                $this->flashmessenger()->addSuccessMessage('The client was saved.');
                
                return $this->redirect()->toRoute('client-view', array(
                    'clientId' => $clientEntity->getClientId()
                ));
            }
        }
        
        $this->layout()->setVariable('pageTitle', 'New Client');
        
        $this->layout()->setVariable('activeMenuItem', 'client');
        
        $this->setHeadTitle('New Client');
        
        return new ViewModel(array(
            'clientForm' => $this->clientForm,
            'userForm' => $this->userForm,
            'LocationForm' => $this->locationForm,
            'phoneForm' => $this->phoneForm
        ));
    }
    
    /**
     * 
     * @param number $clientId
     * @param string $clientName
     */
    private function createAccount($clientId, $clientName)
    {
        // create account
        $accountEntity = new AccountEntity();
        
        $accountEntity->setAccountName($clientName);
        
        $accountEntity->setAccountDescription($clientName . ' Accounts Receivable');
        
        $accountEntity->setAccountActive(1);
        
        $accountEntity->setAccountBalance(0);
        
        $accountEntity->setAccountId(0);
        
        $accountEntity->setAccountTypeId(6);
        
        $accountEntity->setAccountVisible(0);
        
        $accountEntity->setAccountNumber($clientId);
        
        $accountEntity->setAccountCreated(time());
        
        $accountEntity = $this->accountService->save($accountEntity);
        
        // map account
        $clientAccountEntity = new \ClientAccount\Entity\AccountEntity();
        
        $clientAccountEntity->setAccountId($accountEntity->getAccountId());
        
        $clientAccountEntity->setClientId($clientId);
        
        $clientAccountEntity = $this->clientAccountService->save($clientAccountEntity);
    }
    
    
}