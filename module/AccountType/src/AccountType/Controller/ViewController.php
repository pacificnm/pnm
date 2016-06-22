<?php
namespace AccountType\Controller;

use Application\Controller\BaseController;
use AccountType\Service\TypeServiceInterface;
use Zend\View\Model\ViewModel;

class ViewController extends BaseController
{
    /**
     * 
     * @var TypeServiceInterface
     */
    protected $typeService;
    
    protected $accountService;
    
    /**
     * 
     * @param TypeServiceInterface $typeService
     */
    public function __construct(TypeServiceInterface $typeService)
    {
        $this->typeService = $typeService;
    }

    /**
     * 
     * {@inheritDoc}
     * @see \Zend\Mvc\Controller\AbstractActionController::indexAction()
     */
    public function indexAction()
    {
        $id = $this->params()->fromRoute('accountTypeId');
        
        $typeEntity = $this->typeService->get($id);
        
        if(! $typeEntity) {
            $this->flashMessenger()->addErrorMessage('The Account type could not be found');
            
            return $this->redirect()->toRoute('account-view');
        }
        
        
        $this->layout()->setVariable('pageTitle', 'Account Types');
        
        $this->layout()->setVariable('pageSubTitle', 'View');
        
        $this->layout()->setVariable('activeMenuItem', 'account');
        
        $this->layout()->setVariable('activeSubMenuItem', 'account-type-index');
        
        return new ViewModel(array(
            'typeEntity' =>$typeEntity
        ));
    }
}