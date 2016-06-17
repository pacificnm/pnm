<?php
namespace HostAttribute\Controller;

use Application\Controller\BaseController;
use HostAttribute\Service\AttributeServiceInterface;
use Zend\View\Model\ViewModel;

class ViewController extends BaseController
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
        
        $this->layout()->setVariable('pageTitle', 'Host Attribute');
    
        $this->layout()->setVariable('pageSubTitle', '');
    
        $this->layout()->setVariable('activeMenuItem', 'admin');
    
        $this->layout()->setVariable('activeSubMenuItem', 'host-attribute-index');
    
        return new ViewModel(array(
            'attributeEntity' => $attributeEntity
        ));
    }
}
