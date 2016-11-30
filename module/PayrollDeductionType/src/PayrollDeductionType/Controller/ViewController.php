<?php
namespace PayrollDeductionType\Controller;

use Application\Controller\BaseController;
use PayrollDeductionType\Service\PayrollDeductionTypeServiceInterface;
use Zend\View\Model\ViewModel;

class ViewController extends BaseController
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
        $id = $this->params()->fromRoute('payrollDeductionTypeId');
        
        $entity = $this->service->get($id);
        
        if(! $entity) {
            $this->flashMessenger()->addErrorMessage('Payroll Deduction Type not found');
            
            return $this->redirect()->toRoute('payroll-deduction-type-index');
        }
        
        // trigger event
        $this->getEventManager()->trigger('productDeductionTypeView', $this, array(
            'productDeductionTypeEntity' => $entity,
            'authId' => $this->identity()->getAuthId(),
            'historyUrl' => $this->getRequest()->getUri()
        ));
        
        return new ViewModel(array(
            'entity' => $entity
        ));
    }
}