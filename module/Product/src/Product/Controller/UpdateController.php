<?php
namespace Product\Controller;

use Application\Controller\BaseController;
use Product\Service\ProductServiceInterface;
use Product\Form\ProductForm;
use Zend\View\Model\ViewModel;

class UpdateController extends BaseController
{
    /**
     * 
     * @var unknown
     */
    protected $productService;
    
    /**
     * 
     * @var ProductForm
     */
    protected $form;
    
    /**
     * 
     * @param ProductServiceInterface $productService
     * @param ProductForm $form
     */
    public function __construct(ProductServiceInterface $productService, ProductForm $form)
    {
        $this->productService = $productService;
        
        $this->form = $form;
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
        
        $request = $this->getRequest();
        
        // if we have a post
        if ($request->isPost()) {
        
            $postData = $request->getPost();
        
            $this->form->setData($postData);
        
            // if the form is valid
            if ($this->form->isValid()) {
                $entity = $this->form->getData();
        
                $productEntity = $this->productService->save($entity);
        
                // trigger event
                $this->getEventManager()->trigger('productUpdate', $this, array(
                    'productEntity' => $productEntity,
                    'authId' => $this->identity()->getAuthId(),
                    'historyUrl' => $this->getRequest()->getUri()
                ));
        
                // set flash messenger
                $this->flashMessenger()->addSuccessMessage('Product was saved');
        
                // return
                return $this->redirect()->toRoute('product-view', array('productId' => $productId));
            }
        }
        
        $this->form->bind($productEntity);
        
        return new ViewModel(array(
            'form' => $this->form
        ));
    }
}