<?php
namespace User\Controller;

use Application\Controller\BaseController;
use Client\Service\ClientServiceInterface;
use Zend\View\Model\ViewModel;
use User\Service\UserServiceInterface;
use User\Form\UserForm;

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
     * @var UserForm
     */
    protected $userForm;
    
    /**
     * 
     * @param ClientServiceInterface $clientService
     * @param UserServiceInterface $userService
     * @param UserForm $userForm
     */
    public function __construct(ClientServiceInterface $clientService, UserServiceInterface $userService, UserForm $userForm)
    {
        $this->clientService = $clientService;
        
        $this->userService = $userService;
        
        $this->userForm = $userForm;
    }
    
    /**
     *
     * {@inheritDoc}
     * @see \Zend\Mvc\Controller\AbstractActionController::indexAction()
     */
    public function indexAction()
    {
        $id = $this->params()->fromRoute('clientId');
    
        $clientEntity = $this->clientService->get($id);
    
        if (! $clientEntity) {
            
        }
    
        $this->userForm->setClientId($id);
        
        $this->userForm->getLocation();
        
        $this->userForm->get('userId')->setValue(0);
        
        $this->userForm->get('clientId')->setValue($id);
        
        $request = $this->getRequest();
        
        // if we have a post
        if ($request->isPost()) {
            // get post
            $postData = $request->getPost();
        
            $this->userForm->setData($postData);
        
            // if we are valid
            if ($this->userForm->isValid()) {
        
                $entity = $this->userForm->getData();
        
                $entity = $this->userService->save($entity);
        
                $this->flashmessenger()->addSuccessMessage('The user was saved.');
        
                return $this->redirect()->toRoute('user-view', array(
                    'clientId' => $id,
                    'userId' => $entity->getUserId()
                ));
            }
        }
        
        $this->layout()->setVariable('clientId', $id);
    
        $this->layout()->setVariable('pageTitle', 'Create User');
    
        $this->layout()->setVariable('pageSubTitle', $clientEntity->getClientName());
    
        $this->layout()->setVariable('activeMenuItem', 'client');
        
        $this->layout()->setVariable('activeSubMenuItem', 'user-list');
        
        $this->setHeadTitle($clientEntity->getClientName());
    
       
        // return View
        return new ViewModel(array(
            'clientEntity' => $clientEntity,
            'clientId' => $id,
            'form' => $this->userForm
        ));
    }
}