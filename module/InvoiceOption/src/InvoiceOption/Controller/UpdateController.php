<?php
namespace InvoiceOption\Controller;

use Application\Controller\BaseController;
use InvoiceOption\Service\OptionServiceInterface;
use InvoiceOption\Form\OptionForm;
use Zend\View\Model\ViewModel;

class UpdateController extends BaseController
{
    /**
     * 
     * @var OptionServiceInterface
     */
    protected $optionService;
    
    /**
     * 
     * @var optionForm
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
                $optionsEntity = $this->optionForm->getData();
                
                $this->optionService->save($optionsEntity);
                
                $this->setHistory($this->getRequest()
                    ->getUri(), 'UPDATE', $this->identity()
                    ->getAuthId(), 'Admin Edit Invoice Options');
                
                $this->flashmessenger()->addSuccessMessage('The invoice options where saved.');
                
                return $this->redirect()->toRoute('invoice-option-index');
            }
        }
        
        $this->layout()->setVariable('pageTitle', 'Invoice Options');
        
        $this->layout()->setVariable('pageSubTitle', 'Edit');
        
        $this->layout()->setVariable('activeMenuItem', 'admin');
        
        $this->layout()->setVariable('activeSubMenuItem', 'invoice-option-index');
        
        
        
        $optionsEntity = $this->optionService->get(1);
        
        
        $this->optionForm->bind($optionsEntity);
        
        return new ViewModel(array(
            'form' => $this->optionForm
        ));
    }
}
