<?php
namespace PayrollTax\Controller;

use Application\Controller\BaseController;
use PayrollTax\Service\PayrollTaxServiceInterface;
use PayrollTax\Form\PayrollTaxForm;
use Zend\View\Model\ViewModel;

class UpdateController extends BaseController
{
    /**
     * 
     * @var PayrollTaxServiceInterface
     */
    protected $service;
    
    /**
     * 
     * @var PayrollTaxForm
     */
    protected $form;
    
    /**
     * 
     * @param PayrollTaxServiceInterface $service
     * @param PayrollTaxForm $form
     */
    public function __construct(PayrollTaxServiceInterface $service, PayrollTaxForm $form)
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
        
        $payrollTaxEntity = $this->service->get(1);
        
        // if we have a post
        if ($request->isPost()) {
        
            $postData = $request->getPost();
        
            $this->form->setData($postData);
        
            // if the form is valid
            if ($this->form->isValid()) {
        
                $entity = $this->form->getData();
                
                $payrollTaxEntity = $this->service->save($entity);
                
                // trigger event
                $this->getEventManager()->trigger('productTaxUpdate', $this, array(
                    'payrollTaxEntity' => $payrollTaxEntity,
                    'authId' => $this->identity()->getAuthId(),
                    'historyUrl' => $this->getRequest()->getUri()
                ));
                
                $this->flashMessenger()->addSuccessMessage('Payroll Tax information was saved');
                
                return $this->redirect()->toRoute('payroll-tax-index');
            }
        }
        
        // if we have an entity then bind it
        if($payrollTaxEntity) {
            $this->form->bind($payrollTaxEntity);
        }
        
        // return view model
        return new ViewModel(array(
            'form' => $this->form
        ));
    }
}

