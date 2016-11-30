<?php
namespace PayrollDeduction\Controller;

use Application\Controller\BaseController;
use PayrollDeduction\Service\PayrollDeductionServiceInterface;
use PayrollDeduction\Form\PayrollDeductionForm;
use Zend\View\Model\ViewModel;
use Payroll\Service\PayrollServiceInterface;

class CreateController extends BaseController
{

    /**
     *
     * @var PayrollDeductionServiceInterface
     */
    protected $service;

    protected $payrollService;
    /**
     *
     * @var PayrollDeductionForm
     */
    protected $form;

    /**
     *
     * @param PayrollDeductionServiceInterface $service            
     * @param PayrollDeductionForm $form            
     */
    public function __construct(PayrollDeductionServiceInterface $service, PayrollServiceInterface $payrollService, PayrollDeductionForm $form)
    {
        $this->service = $service;
        
        $this->payrollService = $payrollService;
        
        $this->form = $form;
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \Zend\Mvc\Controller\AbstractActionController::indexAction()
     */
    public function indexAction()
    {
        $request = $this->getRequest();
        
        // if we have a post
        if ($request->isPost()) {
            
            $postData = $request->getPost();
            
            $this->form->setData($postData);
            
            // if the form is valid
            if ($this->form->isValid()) {
                
                $entity = $this->form->getData();
                
                // load payroll entity
                $payrollEntity = $this->payrollService->get($entity->getPayrollId());
                
                if(! $payrollEntity) {
                    $this->flashMessenger()->addErrorMessage('Payroll not found');
                    
                    return $this->redirect()->toRoute('payroll-index');
                }
                
                // deduct from net
                $payrollDeductionEntity = $this->service->save($entity);
                
                $payrollEntity->setPayrollWagesNet($payrollEntity->getPayrollWagesNet() - $entity->getPayrollDeductionAmount());
                
                $this->payrollService->save($payrollEntity);
                
                // trigger event
                $this->getEventManager()->trigger('productDeductionCreate', $this, array(
                    'payrollDeductionEntity' => $payrollDeductionEntity,
                    'authId' => $this->identity()->getAuthId(),
                    'historyUrl' => $this->getRequest()->getUri()
                ));
                
                // set flash message
                $this->flashMessenger()->addSuccessMessage('Deduction was saved');
                
                return $this->redirect()->toRoute('payroll-view', array(
                    'payrollId' => $payrollDeductionEntity->getPayrollId()
                ));
            }
        }
        
        return new ViewModel(array(
            'form' => $this->form
        ));
    }
}

