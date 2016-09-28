<?php
namespace PaymentOption\Controller;

use Application\Controller\BaseController;
use PaymentOption\Service\OptionServiceInterface;
use PaymentOption\Form\OptionForm;
use Zend\View\Model\ViewModel;

class CreateController extends BaseController
{

    /**
     *
     * @var OptionServiceInterface
     */
    protected $optionService;

    /**
     *
     * @var OptionForm
     */
    protected $optionForm;

    /**
     *
     * @param OptionServiceInterface $optionService            
     * @param OptionForm $optionForm            
     */
    public function __construct(OptionServiceInterface $optionService, OptionForm $optionForm)
    {
        $this->optionService = $optionService;
        
        $this->optionForm = $optionForm;
    }

    /**
     * 
     * {@inheritDoc}
     * @see \Zend\Mvc\Controller\AbstractActionController::indexAction()
     */
    public function indexAction()
    {
        $request = $this->getRequest();
        
        // if we have a post
        if ($request->isPost()) {
            // get post
            $postData = $request->getPost();
            
            $this->optionForm->setData($postData);
            
            // if we are valid
            if ($this->optionForm->isValid()) {
                $entity = $this->optionForm->getData();
                
                $optionEntity = $this->optionService->save($entity);
                
                $this->flashMessenger()->addSuccessMessage('The payment option was saved.');
                
                return $this->redirect()->toRoute('payment-option-index');
            }
        }
        
        // set form defaults
        $this->optionForm->get('paymentOptionId')->setValue(0);
        
        $this->optionForm->get('paymentOptionEnabled')->setValue(1);
        
        // set layout defaults
        $this->layout()->setVariable('activeMenuItem', 'admin');
        
        $this->layout()->setVariable('activeSubMenuItem', 'payment-option-index');
        
        // return view model
        return new ViewModel(array(
            'form' => $this->optionForm
        ));
    }
}
