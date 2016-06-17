<?php
namespace HostType\Controller;

use Application\Controller\BaseController;
use HostType\Service\TypeServiceInterface;
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
    
        $id = $this->params()->fromRoute('hostTypeId');
        
        $typeEntity = $this->typeService->get($id);
    
        if(! $typeEntity) {
            $this->flashmessenger()->addErrorMessage('Unable to find the host type');
            
            return $this->redirect()->toRoute('host-type-index');
        }
        
        $request = $this->getRequest();
        
        if ($request->isPost()) {
            $del = $request->getPost('delete_confirmation', 'no');
        
            if ($del === 'yes') {
        
                $this->typeService->delete($typeEntity);
        
                $this->flashmessenger()->addSuccessMessage('The host type was deleted');
        
                return $this->redirect()->toRoute('host-type-index');
            }
        
            // return to view
            return $this->redirect()->toRoute('host-type-view', array(
                'hostTypeId' => $id
            ));
        }
        
        $this->layout()->setVariable('pageTitle', 'Delete Host Type');
        
        $this->layout()->setVariable('pageSubTitle', '');
        
        $this->layout()->setVariable('activeMenuItem', 'admin');
        
        $this->layout()->setVariable('activeSubMenuItem', 'host-type-index');
        
        return new ViewModel(array(
            'typeEntity' => $typeEntity
        ));
    }
}