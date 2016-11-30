<?php
namespace Payroll\Controller;

use Application\Controller\BaseController;
use Payroll\Service\PayrollServiceInterface;
use Payroll\Form\PayrollForm;
use Zend\View\Model\ViewModel;
use Employee\Service\EmployeeServiceInterface;
use PayrollTax\Service\PayrollTaxServiceInterface;

class UpdateController extends BaseController
{
    /**
     * 
     * @var PayrollServiceInterface
     */
    protected $service;
    
    /**
     * 
     * @var PayrollForm
     */
    protected $form;
    
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
        
        $id = $this->params()->fromRoute('payrollId');
        
        $payrollEntity = $this->service->get($id);
        
        if(! $payrollEntity) {
            $this->flashMessenger()->addErrorMessage('Payroll not found');
            
            return $this->redirect()->toRoute('payroll-index');
        }
        
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
                $this->getEventManager()->trigger('PayrollUpdate', $this, array(
                    'payrollEntity' => $payrollEntity,
                    'authId' => $this->identity()->getAuthId(),
                    'historyUrl' => $this->getRequest()->getUri()
                ));
                
                $this->flashMessenger()->addSuccessMessage('The payroll entry was saved');
                
                $this->redirect()->toRoute('payroll-view', array('payrollId' => $payrollEntity->getPayrollId()));
            }
        }
        
        // set date
        $payrollEntity->setPayrollDateCreate(date("m/d/Y", $payrollEntity->getPayrollDateCreate()));
        
        $payrollEntity->setPayrollDateEnd(date("m/d/Y", $payrollEntity->getPayrollDateEnd()));
        
        $payrollEntity->setPayrollDateStart(date("m/d/Y", $payrollEntity->getPayrollDateStart()));
        
        // bind form
        $this->form->bind($payrollEntity);
        
        return new ViewModel(array(
            'form' => $this->form,
            'payrollTaxEntity' => $payrollTaxEntity,
            'payrollEntity' => $payrollEntity
        ));
    }
}