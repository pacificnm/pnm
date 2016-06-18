<?php
namespace HostAttributeValue\Controller;

use Application\Controller\BaseController;
use HostAttributeValue\Service\ValueServiceInterface;
use HostAttributeValue\Form\ValueForm;
use HostAttribute\Service\AttributeServiceInterface;
use Zend\View\Model\ViewModel;

class CreateController extends BaseController
{
    /**
     * 
     * @var ValueServiceInterface
     */
    protected $valueService;
    
    /**
     * 
     * @var AttributeServiceInterface
     */
    protected $attributeService;
    
    /**
     * 
     * @var ValueForm
     */
    protected $valueForm;
    
    /**
     * 
     * @param AttributeServiceInterface $attributeService
     * @param ValueServiceInterface $valueService
     * @param ValueForm $valueForm
     */
    public function __construct(AttributeServiceInterface $attributeService, ValueServiceInterface $valueService, ValueForm $valueForm)
    {
        $this->attributeService = $attributeService;
        
        $this->valueService = $valueService;
        
        $this->valueForm = $valueForm;
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
        
        // if we have a post
        if ($request->isPost()) {
            // get post
            $postData = $request->getPost();
        
            $this->valueForm->setData($postData);
        
            // if we are valid
            if ($this->valueForm->isValid()) {
        
                $entity = $this->valueForm->getData();
        
                $entity = $this->valueService->save($entity);
        
                $this->flashmessenger()->addSuccessMessage('The host attribute value was saved');
        
                return $this->redirect()->toRoute('host-attribute-view', array(
                    'hostAttributeId' => $entity->getHostAttributeId()
                ));
            }
        }
        
        $this->valueForm->get('hostAttributeValueId')->setValue(0);
        
        $this->valueForm->get('hostAttributeId')->setValue($id);
        
        $this->layout()->setVariable('pageTitle', 'New Attribute Value');
        
        $this->layout()->setVariable('pageSubTitle', $attributeEntity->getHostAttributeName());
        
        $this->layout()->setVariable('activeMenuItem', 'admin');
        
        $this->layout()->setVariable('activeSubMenuItem', 'host-attribute-index');
        
        return new ViewModel(array(
            'form' => $this->valueForm
        ));
    }
}