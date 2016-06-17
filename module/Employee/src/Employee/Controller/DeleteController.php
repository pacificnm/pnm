<?php
namespace Employee\Controller;

use Application\Controller\BaseController;
use Employee\Service\EmployeeServiceInterface;
use Auth\Service\AuthServiceInterface;
use Zend\View\Model\ViewModel;

class DeleteController extends BaseController
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
     * @param EmployeeServiceInterface $employeeService
     * @param AuthServiceInterface $authService
     */
    public function __construct(EmployeeServiceInterface $employeeService, AuthServiceInterface $authService)
    {
        $this->employeeService = $employeeService;
    
        $this->authService = $authService;
    }
    
    /**
     * 
     * {@inheritDoc}
     * @see \Zend\Mvc\Controller\AbstractActionController::indexAction()
     */
    public function indexAction()
    {
        $this->layout()->setVariable('pageTitle', 'Employee');
    
        $this->layout()->setVariable('pageSubTitle', 'Delete');
    
        $this->layout()->setVariable('activeMenuItem', 'admin');
    
        $this->layout()->setVariable('activeSubMenuItem', 'employee-index');
    
        $id = $this->params()->fromRoute('employeeId');
    
        $employeeEntity = $this->employeeService->get($id);
    
        if(! $employeeEntity) {
            $this->flashmessenger()->addErrorMessage('Unable to find the employee #' . $id);
    
            return $this->redirect()->toRoute('employee-index');
        }
    
        $request = $this->getRequest();
        
        if ($request->isPost()) {
            $del = $request->getPost('delete_confirmation', 'no');
        
            if ($del === 'yes') {
                
                $authEntity = $this->authService->get($employeeEntity->getAuthEntity()->getAuthId());
                
                if($authEntity) {
                    $this->authService->delete($authEntity);
                }
                
                $this->employeeService->delete($employeeEntity);
                
                $this->flashmessenger()->addSuccessMessage('The employee was deleted');
        
                return $this->redirect()->toRoute('employee-index');
            }
        
            return $this->redirect()->toRoute('employee-view', array('employeeId' => $id));
        }
    
        return new ViewModel(array(
            'employeeEntity' => $employeeEntity
        ));
    }
}