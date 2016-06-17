<?php
namespace HostType\Controller;

use Application\Controller\BaseController;
use HostType\Service\TypeServiceInterface;
use Zend\View\Model\ViewModel;
use HostType\Form\TypeForm;

class UpdateController extends BaseController
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
     *
     * @see \Zend\Mvc\Controller\AbstractActionController::indexAction()
     */
    public function indexAction()
    {
        $id = $this->params()->fromRoute('hostTypeId');
        
        $typeEntity = $this->typeService->get($id);
        
        if (! $typeEntity) {
            $this->flashmessenger()->addErrorMessage('Unable to find the host type');
            
            return $this->redirect()->toRoute('host-type-index');
        }
        
        $request = $this->getRequest();
        
        // if we have a post
        if ($request->isPost()) {
            // get post
            $postData = $request->getPost();
            
            $this->typeForm->setData($postData);
            
            // if we are valid
            if ($this->typeForm->isValid()) {
                
                $entity = $this->typeForm->getData();
                
                $entity = $this->typeService->save($entity);
                
                $this->flashmessenger()->addSuccessMessage('The host type was saved');
                
                return $this->redirect()->toRoute('host-type-view', array(
                    'hostTypeId' => $entity->getHostTypeId()
                ));
            }
        }
        
        $this->typeForm->bind($typeEntity);
        
        $this->layout()->setVariable('pageTitle', 'Edit Host Type');
        
        $this->layout()->setVariable('pageSubTitle', '');
        
        $this->layout()->setVariable('activeMenuItem', 'admin');
        
        $this->layout()->setVariable('activeSubMenuItem', 'host-type-index');
        
        return new ViewModel(array(
            'typeEntity' => $typeEntity,
            'form' => $this->typeForm
        ));
    }
}