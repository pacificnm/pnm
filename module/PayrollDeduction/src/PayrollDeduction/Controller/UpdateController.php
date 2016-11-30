<?php
namespace PayrollDeduction\Controller;

use Application\Controller\BaseController;
use PayrollDeduction\Service\PayrollDeductionServiceInterface;
use PayrollDeduction\Form\PayrollDeductionForm;
use Zend\View\Model\ViewModel;

class UpdateController extends BaseController
{
    /**
     * 
     * @var PayrollDeductionServiceInterface
     */
    protected $service;
    
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
    public function __construct(PayrollDeductionServiceInterface $service, PayrollDeductionForm $form)
    {
        $this->service = $service;
        
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
        
        $id = $this->params()->fromRoute('payrollDeductionId');
        
        $entity = $this->service->get($id);
        
        if(! $entity) {
            $this->flashMessenger()->addErrorMessage('Payroll deduction not found');
            
            return $this->redirect()->toRoute('payrol-index');
        }
        
        // if we have a post
        if ($request->isPost()) {
        
            $postData = $request->getPost();
        
            $this->form->setData($postData);
            
            // if the form is valid
            if ($this->form->isValid()) {
            
                $entity = $this->form->getData();
                
                $payrollDeductionEntity = $this->service->save($entity);
                
                // trigger event
                $this->getEventManager()->trigger('productDeductionUpdate', $this, array(
                    'payrollDeductionEntity' => $payrollDeductionEntity,
                    'authId' => $this->identity()->getAuthId(),
                    'historyUrl' => $this->getRequest()->getUri()
                ));
                
                $this->flashMessenger()->addSuccessMessage('Payroll Deduction saved');
                
                return $this->redirect()->toRoute('payroll-view', array('payrollId' => $entity->getPayrollId()));
            }
        }
        
        // bind form
        $this->form->bind($entity);
        
        // return view model
        return new ViewModel(array(
            'form' => $this->form
        ));           
    }
}

