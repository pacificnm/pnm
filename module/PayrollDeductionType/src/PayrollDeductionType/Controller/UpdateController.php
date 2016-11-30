<?php
namespace PayrollDeductionType\Controller;

use Application\Controller\BaseController;
use PayrollDeductionType\Service\PayrollDeductionTypeServiceInterface;
use PayrollDeductionType\Form\PayrollDeductionTypeForm;
use Zend\View\Model\ViewModel;

class UpdateController extends BaseController
{

    /**
     *
     * @var PayrollDeductionTypeServiceInterface
     */
    protected $service;

    /**
     *
     * @var PayrollDeductionTypeForm
     */
    protected $form;

    /**
     *
     * @param PayrollDeductionTypeServiceInterface $service            
     * @param PayrollDeductionTypeForm $form            
     */
    public function __construct(PayrollDeductionTypeServiceInterface $service, PayrollDeductionTypeForm $form)
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
        
        $id = $this->params()->fromRoute('payrollDeductionTypeId');
        
        $entity = $this->service->get($id);
        
        if (! $entity) {
            $this->flashMessenger()->addErrorMessage('Payroll Deduction Type not found');
            
            return $this->redirect()->toRoute('payroll-deduction-type-index');
        }
        
        // if we have a post
        if ($request->isPost()) {
            
            $postData = $request->getPost();
            
            $this->form->setData($postData);
            
            // if the form is valid
            if ($this->form->isValid()) {
                
                $entity = $this->form->getData();
                
                $productDeductionTypeEntity = $this->service->save($entity);
                
                // trigger event
                $this->getEventManager()->trigger('productDeductionTypeUpdate', $this, array(
                    'productDeductionTypeEntity' => $productDeductionTypeEntity,
                    'authId' => $this->identity()->getAuthId(),
                    'historyUrl' => $this->getRequest()->getUri()
                ));
                
                // set flash messenger
                $this->flashMessenger()->addSuccessMessage('Payroll Deduction Type saved');
                
                // return to index
                return $this->redirect()->toRoute('payroll-deduction-type-view', array(
                    'payrollDeductionTypeId' => $productDeductionTypeEntity->getPayrollDeductionTypeId()
                ));
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