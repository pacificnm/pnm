<?php
namespace PayrollDeduction\Controller;

use Application\Controller\BaseController;
use PayrollDeduction\Service\PayrollDeductionServiceInterface;
use Zend\View\Model\ViewModel;

class DeleteController extends BaseController
{

    /**
     *
     * @var PayrollDeductionServiceInterface
     */
    protected $service;

    /**
     *
     * @param PayrollDeductionServiceInterface $service            
     */
    public function __construct(PayrollDeductionServiceInterface $service)
    {
        $this->service = $service;
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
        
        $id = $this->params()->fromRoute('payrollDeductionId');
        
        $entity = $this->service->get($id);
        
        if (! $entity) {
            $this->flashMessenger()->addErrorMessage('Payroll Deduction not found');
            
            return $this->redirect()->toRoute('payroll-index');
        }
        
        // if we have a post
        if ($request->isPost()) {
        
            $del = $request->getPost('delete_confirmation', 'no');
        
            if ($del === 'yes') {
                $this->service->delete($entity);
                
                // trigger event
                $this->getEventManager()->trigger('productDeductionDelete', $this, array(
                    'productDeductionEntity' => $entity,
                    'authId' => $this->identity()->getAuthId(),
                    'historyUrl' => $this->getRequest()->getUri()
                ));
                
                $this->flashMessenger()->addSuccessMessage('Payroll Deduction was deleted');
            }
            return $this->redirect()->toRoute('payroll-view', array('payrollId' => $entity->getPayrollId()));
        }
        
        // return view
        return new ViewModel(array(
            'entity' => $entity
        ));
    }
}

