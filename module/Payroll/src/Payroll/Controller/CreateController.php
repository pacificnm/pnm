<?php
namespace Payroll\Controller;

use Application\Controller\BaseController;
use Payroll\Service\PayrollServiceInterface;
use Payroll\Form\PayrollForm;
use Zend\View\Model\ViewModel;
use Employee\Service\EmployeeServiceInterface;
use PayrollTax\Service\PayrollTaxServiceInterface;

class CreateController extends BaseController
{
    /**
     * 
     * @var PayrollServiceInterface
     */
    protected $service;
    
    /**
     * 
     * @var PayrollTaxServiceInterface
     */
    protected $payrollTaxService;
    
    /**
     * 
     * @var EmployeeServiceInterface
     */
    protected $employeeService;
    
    /**
     * 
     * @var PayrollForm
     */
    protected $form;
    
    /**
     * 
     * @param PayrollServiceInterface $service
     * @param PayrollTaxServiceInterface $payrollTaxService
     * @param EmployeeServiceInterface $employeeService
     * @param PayrollForm $form
     */
    public function __construct(PayrollServiceInterface $service, PayrollTaxServiceInterface $payrollTaxService, EmployeeServiceInterface $employeeService, PayrollForm $form)
    {
        $this->service = $service;
        
        $this->payrollTaxService = $payrollTaxService;
        
        $this->employeeService = $employeeService;
        
        $this->form = $form;
    }
    
    /**
     * 
     * {@inheritDoc}
     * @see \Zend\Mvc\Controller\AbstractActionController::indexAction()
     */
    public function indexAction()
    {
        $request = $this->getRequest();
        
        $payrollTaxEntity = $this->payrollTaxService->get(1);
        
        // if we have a post
        if ($request->isPost()) {
        
            $postData = $request->getPost();
        
            $this->form->setData($postData);
        
            // if the form is valid
            if ($this->form->isValid()) {
                
                $entity = $this->form->getData();
                
                // fix times
                $entity->setPayrollDateCreate(strtotime($entity->getPayrollDateCreate()));
                
                $entity->setPayrollDateStart(strtotime($entity->getPayrollDateStart()));
                
                $entity->setPayrollDateEnd(strtotime($entity->getPayrollDateEnd()));
                
                $payrollEntity = $this->service->save($entity);
                
                // trigger event
                $this->getEventManager()->trigger('PayrollCreate', $this, array(
                    'payrollEntity' => $payrollEntity,
                    'authId' => $this->identity()->getAuthId(),
                    'historyUrl' => $this->getRequest()->getUri()
                ));
                
                $this->flashMessenger()->addSuccessMessage('The payroll entry was saved');
                
                $this->redirect()->toRoute('payroll-view', array('payrollId' => $payrollEntity->getPayrollId()));
            }
        }
        
        // set form up
        $this->form->get('payrollId')->setValue(0);
        
        // return view model
        return new ViewModel(array(
            'form' => $this->form,
            'payrollTaxEntity' => $payrollTaxEntity
        ));
    }
}