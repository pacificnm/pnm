<?php
namespace Payroll\Controller;

use Application\Controller\BaseController;
use Payroll\Service\PayrollServiceInterface;
use Zend\View\Model\ViewModel;
use Zend\Crypt\BlockCipher;
use PayrollDeduction\Form\PayrollDeductionForm;
use PayrollDeduction\Service\PayrollDeductionServiceInterface;

class ViewController extends BaseController
{
    /**
     * 
     * @var PayrollServiceInterface
     */
    protected $service;
    
    /**
     * 
     * @var PayrollDeductionServiceInterface
     */
    protected $payrollDeductionService;
    
    /**
     *
     * @var BlockCipher
     */
    protected $blockCipher;
    
    /**
     * 
     * @var PayrollDeductionForm
     */
    protected $form;
    
    /**
     * 
     * @param PayrollServiceInterface $service
     * @param PayrollDeductionServiceInterface $payrollDeductionService
     * @param BlockCipher $blockCipher
     * @param PayrollDeductionForm $form
     */
    public function __construct(PayrollServiceInterface $service, PayrollDeductionServiceInterface $payrollDeductionService, BlockCipher $blockCipher, PayrollDeductionForm $form)
    {
        $this->service = $service;
        
        $this->payrollDeductionService = $payrollDeductionService;
        
        $this->blockCipher = $blockCipher;
        
        $this->form = $form;
    }
    
    /**
     * 
     * {@inheritDoc}
     * @see \Zend\Mvc\Controller\AbstractActionController::indexAction()
     */
    public function indexAction()
    {
        $id = $this->params()->fromRoute('payrollId');
        
        $entity = $this->service->get($id);
        
        if(! $entity) {
            $this->flashMessenger()->addErrorMessage('Payroll not found');
            
            return $this->redirect()->toRoute('payroll-index');
        }
        
        // trigger event
        $this->getEventManager()->trigger('PayrollView', $this, array(
            'payrollEntity' => $entity,
            'authId' => $this->identity()->getAuthId(),
            'historyUrl' => $this->getRequest()->getUri()
        ));
        
        // get year
        $year = date("Y", $entity->getPayrollDateCreate());
        
        // set ssi number
        $entity->getEmployeeEntity()->setEmployeeSsn('###-##-'.substr($this->blockCipher->decrypt($entity->getEmployeeEntity()->getEmployeeSsn()), -4));
        
        // ytd federal income tax
        $ytdFederalIncomeTax = $this->service->getYtdFederalIncomeTax($entity->getEmployeeId(), $year);
        
        $ytdSocialSecurityTax = $this->service->getYtdSocialSecurityTax($entity->getEmployeeId(), $year);
        
        $ytdMedicareTax = $this->service->getYtdMedicareTax($entity->getEmployeeId(), $year);
        
        $ytdStateTax = $this->service->getYtdStateTax($entity->getEmployeeId(), $year);
        
        $ytdGross = $this->service->getYtdGross($entity->getEmployeeId(), $year);
        
        $ytdNet = $this->service->getYtdNet($entity->getEmployeeId(), $year);
        
        // set up deduction form
        $this->form->setAttribute('action', $this->url()->fromRoute('payroll-deduction-create'));
        
        $this->form->get('payrollDeductionId')->setValue(0);
        
        $this->form->get('payrollId')->setValue($id);
        
        $this->form->get('payrollDeductionYear')->setValue(date("Y", time()));
        
        // get deductions
        $payrollDeductionEntitys = $this->payrollDeductionService->getPayrollDeductions($id);
        
        // return view model
        return new ViewModel(array(
            'entity' => $entity,
            'ytdFederalIncomeTax' => $ytdFederalIncomeTax,
            'ytdSocialSecurityTax' => $ytdSocialSecurityTax,
            'ytdMedicareTax' => $ytdMedicareTax,
            'ytdStateTax' => $ytdStateTax,
            'ytdGross' => $ytdGross,
            'ytdNet' => $ytdNet,
            'form' => $this->form,
            'payrollDeductionEntitys' => $payrollDeductionEntitys
        ));
    }
}