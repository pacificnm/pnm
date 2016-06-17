<?php
namespace HostAttribute\Controller;

use Application\Controller\BaseController;
use HostAttribute\Service\AttributeServiceInterface;
use Zend\View\Model\ViewModel;

class DeleteController extends BaseController
{
    /**
     *
     * @var AttributeServiceInterface
     */
    protected $attributeService;
    
    /**
     *
     * @param AttributeServiceInterface $attributeService
     */
    public function __construct(AttributeServiceInterface $attributeService)
    {
        $this->attributeService = $attributeService;
    }
    
    /**
     *
     * {@inheritDoc}
     * @see \Zend\Mvc\Controller\AbstractActionController::indexAction()
     */
    public function indexAction()
    {
        $id = $this->params()->fromRoute('hostAttributeId');
        
        $attributeEntity = $this->attributeService->get($id);
        
        if(! $attributeEntity) {
            $this->flashmessenger()->addErrorMessage('Unable to find the host attribute');
        
            return $this->redirect()->toRoute('host-attribute-index');
        }
        
        $request = $this->getRequest();
        
        if ($request->isPost()) {
            $del = $request->getPost('delete_confirmation', 'no');
        
            if ($del === 'yes') {
        
                $this->attributeService->delete($attributeEntity);
        
                $this->flashmessenger()->addSuccessMessage('The host attribute was deleted');
        
                return $this->redirect()->toRoute('host-attribute-index');
            }
        
            // return to view
            return $this->redirect()->toRoute('host-attribute-view', array(
                'hostAttributeId' => $id
            ));
        }
        
        $this->layout()->setVariable('pageTitle', 'Host Attribute');
    
        $this->layout()->setVariable('pageSubTitle', '');
    
        $this->layout()->setVariable('activeMenuItem', 'admin');
    
        $this->layout()->setVariable('activeSubMenuItem', 'host-attribute-index');
    
        return new ViewModel(array(
            'attributeEntity' => $attributeEntity
        ));
    }
}