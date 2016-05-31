<?php
namespace Employee\Controller;

use Application\Controller\BaseController;
use Employee\Service\EmployeeServiceInterface;
use Auth\Service\AuthServiceInterface;
use Zend\View\Model\ViewModel;
use Employee\Form\EmployeeCreateForm;
use Auth\Entity\AuthEntity;
use Zend\Crypt\Password\Bcrypt;

class CreateController extends BaseController
{
    /**
     *
     * @var EmployeeServiceInterface
     */
    protected $employeeService;
    
    /**
     *
     * @var AuthServiceInterface
     */
    protected $authService;
    
    /**
     *
     * @var EmployeeCreateForm
     */
    protected $employeeCreateForm;
    
    /**
     * 
     * @param EmployeeServiceInterface $employeeService
     * @param AuthServiceInterface $authService
     * @param EmployeeCreateForm $employeeCreateForm
     */
    public function __construct(EmployeeServiceInterface $employeeService, AuthServiceInterface $authService, EmployeeCreateForm $employeeCreateForm)
    {
        $this->employeeService = $employeeService;
    
        $this->authService = $authService;
    
        $this->employeeCreateForm = $employeeCreateForm;
    }
    
    /**
     * 
     * {@inheritDoc}
     * @see \Zend\Mvc\Controller\AbstractActionController::indexAction()
     */
    public function indexAction()
    {
        $this->layout()->setVariable('pageTitle', 'Employee');
        
        $this->layout()->setVariable('pageSubTitle', 'Create');
        
        $this->layout()->setVariable('activeMenuItem', 'admin');
        
        $this->layout()->setVariable('activeSubMenuItem', 'employee-index');

        $this->employeeCreateForm->get('employeeId')->setValue(0);
        
        $this->employeeCreateForm->get('authRole')->setValue('employee');
        
        $request = $this->getRequest();
        
        // if we have a post
        if ($request->isPost()) {
            // get post
            $postData = $request->getPost();
            
            $this->employeeCreateForm->setData($postData);
            
            // if we are valid
            if ($this->employeeCreateForm->isValid()) {
                
                $bcrypt = new Bcrypt();
                
                $authEntity = new AuthEntity();
                
                $employeeEntity = $this->employeeService->save($this->employeeCreateForm->getData());
                
                $authEntity->setAuthEmail($employeeEntity->getEmployeeEmail());
                
                $authEntity->setAuthId(0);
                
                $authEntity->setAuthLastIp(0);
                
                $authEntity->setAuthLastLogin('');
                
                $authEntity->setAuthName($employeeEntity->getEmployeeName());
                
                $authEntity->setAuthPassword($bcrypt->create($postData['authPassword']));
                
                $authEntity->setAuthRole($postData['authRole']);
                
                $authEntity->setAuthType('Employee');
                
                $authEntity->setEmployeeId($employeeEntity->getEmployeeId());
                
                $authEntity->setUserId(0);
                
                $authEntity = $this->authService->save($authEntity);
                
                $this->flashmessenger()->addSuccessMessage('The employee was saved');
                
                return $this->redirect()->toRoute('employee-view', array(
                    'employeeId' => $employeeEntity->getEmployeeId()
                ));
                
            }
        }
        
        return new ViewModel(array(
            'form' => $this->employeeCreateForm
        ));
    }
}