<?php
namespace Product\Controller;

use Application\Controller\BaseController;
use Product\Service\ProductServiceInterface;
use Zend\View\Model\ViewModel;

class DeleteController extends BaseController
{

    /**
     *
     * @var ProductServiceInterface
     */
    protected $productService;

    /**
     *
     * @param ProductServiceInterface $productService            
     */
    public function __construct(ProductServiceInterface $productService)
    {
        $this->productService = $productService;
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \Zend\Mvc\Controller\AbstractActionController::indexAction()
     */
    public function indexAction()
    {
        $productId = $this->params('productId');
        
        $productEntity = $this->productService->get($productId);
        
        $request = $this->getRequest();
        
        // if we didnt get one not found
        if (! $productEntity) {
            $this->flashMessenger()->addErrorMessage('Product not found');
            
            return $this->redirect()->toRoute('product-index');
        }
        
        // if we have a post
        if ($request->isPost()) {
            $del = $request->getPost('delete_confirmation', 'no');
            
            if ($del === 'yes') {
                $this->productService->delete($productEntity);
                
                // trigger event
                $this->getEventManager()->trigger('productDelete', $this, array(
                    'productEntity' => $productEntity,
                    'authId' => $this->identity()->getAuthId(),
                    'historyUrl' => $this->getRequest()->getUri()
                ));
                
                $this->flashMessenger()->addSuccessMessage('Product was deleted');
                
                return $this->redirect()->toRoute('product-index');
            }
            
            return $this->redirect()->toRoute('product-view', array('productId' => $productId));
        }
        
        return new ViewModel(array(
            'productEntity' => $productEntity
        ));
    }
}
