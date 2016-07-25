<?php
namespace WorkorderOption\Controller;

use Application\Controller\BaseController;
use WorkorderOption\Service\OptionServiceInterface;
use WorkorderOption\Form\OptionForm;
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
        
                
                
                $optionsEntity = $this->optionService->save($entity);
        
               
                
                $this->setHistory($this->getRequest()
                    ->getUri(), 'UPDATE', $this->identity()
                    ->getAuthId(), 'Admin Edit Work Order Options');
        
                $this->flashmessenger()->addSuccessMessage('The work order options where saved.');
        
                return $this->redirect()->toRoute('workorder-option-index');
            }
        }
        
        $this->layout()->setVariable('pageTitle', 'Work Order Options');
        
        $this->layout()->setVariable('pageSubTitle', 'Edit');
        
        $this->layout()->setVariable('activeMenuItem', 'admin');
        
        $this->layout()->setVariable('activeSubMenuItem', 'workorder-option-index');
        
        $optionsEntity = $this->optionService->get(1);
        
        if($optionsEntity) {
            $this->optionForm->bind($optionsEntity);
        } else {
            $this->optionForm->get('workorderOptionId')->setValue(0);
        }
        
        
        
        return new ViewModel(array(
            'form' => $this->optionForm
        ));
    }
}

