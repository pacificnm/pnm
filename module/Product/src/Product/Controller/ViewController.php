<?php
namespace Product\Controller;

use Application\Controller\BaseController;
use Product\Service\ProductServiceInterface;
use Zend\View\Model\ViewModel;

class ViewController extends BaseController
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
     * @see \Zend\Mvc\Controller\AbstractActionController::indexAction()
     */
    public function indexAction()
    {
        $productId = $this->params('productId');
        
        $productEntity = $this->productService->get($productId);
        
        // if we didnt get one not found
        if(! $productEntity) {
            $this->flashMessenger()->addErrorMessage('Product not found');
            
            return $this->redirect()->toRoute('product-index');
        }
        
        // trigger event
        $this->getEventManager()->trigger('productView', $this, array(
            'productEntity' => $productEntity,
            'authId' => $this->identity()->getAuthId(),
            'historyUrl' => $this->getRequest()->getUri()
        ));
        
        // return view model
        return new ViewModel(array(
            'productEntity' => $productEntity
        ));
    }
}