<?php
namespace HostAttribute\Controller;

use Application\Controller\BaseController;
use HostAttribute\Service\AttributeServiceInterface;
use Zend\View\Model\ViewModel;
use HostAttribute\Form\AttributeForm;

class CreateController extends BaseController
{
    /**
     *
     * @var AttributeServiceInterface
     */
    protected $attributeService;
    
    /**
     * 
     * @var AttributeForm
     */
    protected $attributeForm;
    /**
     * 
     * @param AttributeServiceInterface $attributeService
     * @param AttributeForm $attributeForm
     */
    public function __construct(AttributeServiceInterface $attributeService, AttributeForm $attributeForm)
    {
        $this->attributeService = $attributeService;
        
        $this->attributeForm = $attributeForm;
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
        
            $this->attributeForm->setData($postData);
        
            // if we are valid
            if ($this->attributeForm->isValid()) {
        
                $entity = $this->attributeForm->getData();
        
                $entity = $this->attributeService->save($entity);
        
                $this->flashmessenger()->addSuccessMessage('The host attribute was saved');
        
                return $this->redirect()->toRoute('host-attribute-view', array(
                    'hostAttributeId' => $entity->getHostAttributeId()
                ));
            }
        }
    
        $this->attributeForm->get('hostAttributeId')->setValue(0);
        
        $this->layout()->setVariable('pageTitle', 'New Host Attribute');
    
        $this->layout()->setVariable('pageSubTitle', '');
    
        $this->layout()->setVariable('activeMenuItem', 'admin');
    
        $this->layout()->setVariable('activeSubMenuItem', 'host-attribute-index');
    
        return new ViewModel(array(
            'form' => $this->attributeForm
        ));
    }
}