<?php
namespace ProductType\Controller;

use Application\Controller\BaseController;
use Zend\View\Model\ViewModel;
use ProductType\Service\ProductTypeServiceInterface;

class ViewController extends BaseController
{
    /**
     *
     * @var ProductTypeServiceInterface
     */
    protected $service;
    
    /**
     *
     * @param ProductTypeServiceInterface $service
     */
    public function __construct(ProductTypeServiceInterface $service)
    {
        $this->service = $service;
    }
    
    /**
     *
     * {@inheritdoc}
     *
     * @see \Zend\Mvc\Controller\AbstractActionController::indexAction()
     */
    public function indexAction()
    {
        $id = $this->params()->fromRoute('productTypeId');
        
        $entity = $this->service->get($id);
        
        if(! $entity) {
            $this->flashMessenger()->addErrorMessage('Product type not found');
            
            return $this->redirect()->toRoute('product-type-index');
        }
        
        // trigger event
        $this->getEventManager()->trigger('ProductTypeView', $this, array(
            'authId' => $this->identity()->getAuthId(),
            'historyUrl' => $this->getRequest()->getUri(),
            'productTypeEntity' => $entity
        ));
        
        // return view model
        return new ViewModel(array(
            'entity' => $entity
        ));
    }
}

