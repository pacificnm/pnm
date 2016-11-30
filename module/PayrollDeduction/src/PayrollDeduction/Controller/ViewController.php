<?php
namespace PayrollDeduction\Controller;

use Application\Controller\BaseController;
use PayrollDeduction\Service\PayrollDeductionServiceInterface;
use Zend\View\Model\ViewModel;

class ViewController extends BaseController
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
     * {@inheritDoc}
     * @see \Zend\Mvc\Controller\AbstractActionController::indexAction()
     */
    public function indexAction()
    {
        $id = $this->params()->fromRoute('payrollDeductionId');
        
        $entity = $this->service->get($id);
        
        // validate we found one
        if(! $entity) {
            $this->flashMessenger()->addErrorMessage('Payroll deduction not found');
            
            return $this->redirect()->toRoute('payroll-index');
        }
        
        // trigger event
        $this->getEventManager()->trigger('PayrollDeductionView', $this, array(
            'payrollDeductionEntity' => $entity,
            'authId' => $this->identity()->getAuthId(),
            'historyUrl' => $this->getRequest()->getUri()
        ));

        // return view model
        return new ViewModel(array(
            'entity' => $entity
        ));
    }
}

