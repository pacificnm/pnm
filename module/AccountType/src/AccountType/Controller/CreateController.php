<?php
namespace AccountType\Controller;

use Application\Controller\BaseController;
use AccountType\Service\TypeServiceInterface;
use AccountType\Form\TypeForm;
use Zend\View\Model\ViewModel;

class CreateController extends BaseController
{
    /**
     * 
     * @var TypeServiceInterface
     */
    protected $typeService;
    
    /**
     * 
     * @var TypeForm
     */
    protected $typeForm;
    
    /**
     * 
     * @param TypeServiceInterface $typeService
     * @param TypeForm $typeForm
     */
    public function __construct(TypeServiceInterface $typeService, TypeForm $typeForm)
    {
        $this->typeService = $typeService;
        
        $this->typeForm = $typeForm;
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
        
            $this->typeForm->setData($postData);
        
            // if we are valid
            if ($this->typeForm->isValid()) {
        
                $entity = $this->typeForm->getData();
                
                $typeEntity = $this->typeService->save($entity);
               
                $this->flashmessenger()->addSuccessMessage('The account type was saved');
        
                return $this->redirect()->toRoute('account-type-index');
            }
        }
     
        $this->typeForm->get('accountTypeId')->setValue(0);
        
        $this->typeForm->get('accountTypeActive')->setValue(1);
        
        $this->layout()->setVariable('pageTitle', 'Account Types');
        
        $this->layout()->setVariable('pageSubTitle', 'Create');
        
        $this->layout()->setVariable('activeMenuItem', 'account');
        
        $this->layout()->setVariable('activeSubMenuItem', 'account-type-index');
        
        return new ViewModel(array(
            'form' => $this->typeForm
        ));
    }
}