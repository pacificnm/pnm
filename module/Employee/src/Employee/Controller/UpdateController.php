<?php
namespace Employee\Controller;

use Application\Controller\BaseController;
use Employee\Service\EmployeeServiceInterface;
use Auth\Service\AuthServiceInterface;
use Zend\View\Model\ViewModel;
use Employee\Form\EmployeeForm;


class UpdateController extends BaseController
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
     * @var EmployeeForm
     */
    protected $employeeForm;

    /**
     * 
     * @param EmployeeServiceInterface $employeeService
     * @param AuthServiceInterface $authService
     * @param EmployeeForm $employeeForm
     */
    public function __construct(EmployeeServiceInterface $employeeService, AuthServiceInterface $authService, EmployeeForm $employeeForm)
    {
        $this->employeeService = $employeeService;
        
        $this->authService = $authService;
        
        $this->employeeForm = $employeeForm;
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \Zend\Mvc\Controller\AbstractActionController::indexAction()
     */
    public function indexAction()
    {
        $this->layout()->setVariable('pageTitle', 'Employee');
        
        $this->layout()->setVariable('pageSubTitle', 'Edit');
        
        $this->layout()->setVariable('activeMenuItem', 'admin');
        
        $this->layout()->setVariable('activeSubMenuItem', 'employee-index');
        
        $id = $this->params()->fromRoute('employeeId');
        
        $employeeEntity = $this->employeeService->get($id);
        
        if (! $employeeEntity) {
            $this->flashmessenger()->addErrorMessage('Unable to find the employee #' . $id);
            
            return $this->redirect()->toRoute('employee-index');
        }
        
        // update auth
        $authEntity = $this->authService->get($employeeEntity->getAuthEntity()->getAuthId());
        
        if(! $authEntity) {
            $this->flashmessenger()->addErrorMessage('Unable to find the authEntity');
            
            return $this->redirect()->toRoute('employee-index');
        }
        
        
        $this->employeeForm->bind($employeeEntity);
        
        $request = $this->getRequest();
        
        
        
        // if we have a post
        if ($request->isPost()) {
            // get post
            $postData = $request->getPost();
            
            $this->employeeForm->setData($postData);
            
            // if we are valid
            if ($this->employeeForm->isValid()) {
                
                $employeeEntity = $this->employeeForm->getData();
                
                $employeeEntity = $this->employeeService->save($employeeEntity);
                
                $authEntity->setAuthEmail($employeeEntity->getEmployeeEmail());
                
                $authEntity->setAuthName($employeeEntity->getEmployeeName());
                
                $this->authService->save($authEntity);
                
                $this->flashmessenger()->addSuccessMessage('The employee was saved');
                
                return $this->redirect()->toRoute('employee-view', array(
                    'employeeId' => $id
                ));
            }
        }
        return new ViewModel(array(
            'employeeEntity' => $employeeEntity,
            'form' => $this->employeeForm
        ));
    }
}
