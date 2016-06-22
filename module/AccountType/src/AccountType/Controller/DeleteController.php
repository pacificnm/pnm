<?php
namespace AccountType\Controller;

use Application\Controller\BaseController;
use AccountType\Service\TypeServiceInterface;
use Zend\View\Model\ViewModel;

class DeleteController extends BaseController
{
    /**
     * 
     * @var TypeServiceInterface
     */
    protected $typeService;
    
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
        
        $request = $this->getRequest();
        
        if ($request->isPost()) {
            $del = $request->getPost('delete_confirmation', 'no');
        
            if ($del === 'yes') {
        
                $typeEntity->setAccountTypeActive(0);
        
                $this->typeService->save($typeEntity);
        
                $this->flashmessenger()->addSuccessMessage('The account type was deleted');
        
                return $this->redirect()->toRoute('account-type-index');
            }
        
            // return to view
            return $this->redirect()->toRoute('account-type-view', array(
                'accountTypeId' => $id
            ));
        }
        
        
        return new ViewModel(array(
            'typeEntity' => $typeEntity
        ));
    }
}