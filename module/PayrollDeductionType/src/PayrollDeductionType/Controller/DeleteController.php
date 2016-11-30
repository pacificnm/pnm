<?php
namespace PayrollDeductionType\Controller;

use Application\Controller\BaseController;
use PayrollDeductionType\Service\PayrollDeductionTypeServiceInterface;
use Zend\View\Model\ViewModel;

class DeleteController extends BaseController
{
    /**
     * 
     * @var PayrollDeductionTypeServiceInterface
     */
    protected $service;
    
    /**
     * 
     * @param PayrollDeductionTypeServiceInterface $service
     */
    public function __construct(PayrollDeductionTypeServiceInterface $service)
    {
        $this->service = $service;
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
        
        if(! $entity) {
            $this->flashMessenger()->addErrorMessage('Payroll Deduction Type not found');
        
            return $this->redirect()->toRoute('payroll-deduction-type-index');
        }
        
        // if we have a post
        if ($request->isPost()) {
            
            $del = $request->getPost('delete_confirmation', 'no');
        
            if ($del === 'yes') {
                
                $this->service->delete($entity);
        
                // trigger event
                $this->getEventManager()->trigger('productDeductionTypeDelete', $this, array(
                    'productDeductionTypeEntity' => $entity,
                    'authId' => $this->identity()->getAuthId(),
                    'historyUrl' => $this->getRequest()->getUri()
                ));
        
                $this->flashMessenger()->addSuccessMessage('Payroll Deduction Type was deleted');
        
                return $this->redirect()->toRoute('payroll-deduction-type-index');
            }
        
            return $this->redirect()->toRoute('payroll-deduction-type-view', array(
                    'payrollDeductionTypeId' => $entity->getPayrollDeductionTypeId()
                ));
        }
        
        return new ViewModel(array(
            'entity' => $entity
        ));
    }
}