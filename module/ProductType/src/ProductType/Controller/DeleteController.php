<?php
namespace ProductType\Controller;

use Application\Controller\BaseController;
use Zend\View\Model\ViewModel;
use ProductType\Service\ProductTypeServiceInterface;

class DeleteController extends BaseController
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
        $request = $this->getRequest();
        
        $id = $this->params()->fromRoute('productTypeId');
        
        $entity = $this->service->get($id);
        
        if(! $entity) {
            $this->flashMessenger()->addErrorMessage('Product type not found');
        
            return $this->redirect()->toRoute('product-type-index');
        }
        
        // if we have a post
        if ($request->isPost()) {
            $del = $request->getPost('delete_confirmation', 'no');
        
            if ($del === 'yes') {
                $this->service->delete($entity);
        
                // trigger event
                $this->getEventManager()->trigger('productTypeDelete', $this, array(
                    'authId' => $this->identity()->getAuthId(),
                    'historyUrl' => $this->getRequest()->getUri(),
                    'productTypeEntity' => $entity,
                ));
        
                $this->flashMessenger()->addSuccessMessage('Product type was deleted');
        
                return $this->redirect()->toRoute('product-type-index');
            }
        
            return $this->redirect()->toRoute('product-type-view', array('productId' => $id));
        }
        
        // return view model
        return new ViewModel(array(
            'entity' => $entity
        ));
    }
}

