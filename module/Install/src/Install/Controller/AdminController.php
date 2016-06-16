<?php

namespace Install\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Employee\Service\EmployeeServiceInterface;
use Install\Form\AdminForm;
use Auth\Service\AuthServiceInterface;
use Auth\Entity\AuthEntity;
use Zend\Crypt\Password\Bcrypt;

class AdminController extends AbstractActionController
{
    /**
     * 
     * @var AuthServiceInterface
     */
    protected $authService;
    
    /**
     * 
     * @var EmployeeServiceInterface
     */
    protected $employeeService;
    
    /**
     * 
     * @var AdminForm
     */
    protected $adminForm;

    /**
     * 
     * @param AuthServiceInterface $authService
     * @param EmployeeServiceInterface $employeeService
     * @param AdminForm $adminForm
     */
    public function __construct(AuthServiceInterface $authService, EmployeeServiceInterface $employeeService, AdminForm $adminForm)
    {
        $this->authService = $authService;
        
        $this->employeeService = $employeeService;
        
        $this->adminForm = $adminForm;
    }
    
    /**
     * 
     * {@inheritDoc}
     * @see \Zend\Mvc\Controller\AbstractActionController::indexAction()
     */
    public function indexAction()
    {
        if(is_file('data/install')) {
            return $this->redirect()->toRoute('home');    
        }
        
        $this->layout('layout/install.phtml');
        
        $request = $this->getRequest();
        
        // if we have a post
        if ($request->isPost()) {
            // get post
            $postData = $request->getPost();
        
            $this->adminForm->setData($postData);
        
            // if we are valid
            if ($this->adminForm->isValid()) {
                $bcrypt = new Bcrypt();
                
                $entity = $this->adminForm->getData();
                
               
                
                $entity->setEmployeeStatus('Active');
                
                $employeeEntity = $this->employeeService->save($entity);
                
                $authEntity = new AuthEntity();
                
                $authEntity->setAuthEmail($employeeEntity->getEmployeeEmail());
                
                $authEntity->setAuthName($employeeEntity->getEmployeeName());
                
                $authEntity->setAuthPassword($bcrypt->create($postData['authPassword']));
                
                $authEntity->setAuthRole('administrator');
                
                $authEntity->setAuthType('Employee');
                
                $authEntity->setEmployeeId($employeeEntity->getEmployeeId());
                
                $authEntity->setUserId(0);
                
                $authEntity->setAuthLastIp($_SERVER['REMOTE_ADDR']);
                
                $authEntity->setAuthLastLogin(time());
                
                $authEntity = $this->authService->save($authEntity);
                
                
                // set install file
                touch('data/install');
                
                
                $this->flashmessenger()->addSuccessMessage('Install completed');
                
                return $this->redirect()->toRoute('install-complete');
            }
        }
        
        $this->adminForm->get('employeeId')->setValue(0);
        
        // return array
        return new ViewModel(array(
            'form' => $this->adminForm
        ));
    }


}

