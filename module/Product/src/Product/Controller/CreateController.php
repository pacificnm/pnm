<?php
namespace Product\Controller;

use Application\Controller\BaseController;
use Product\Service\ProductServiceInterface;
use Product\Form\ProductForm;
use Zend\View\Model\ViewModel;

class CreateController extends BaseController
{

    /**
     *
     * @var ProductServiceInterface
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
     */
    public function __construct(ProductServiceInterface $productService)
    {
        $this->productService = $productService;
        
        $this->form = new ProductForm();
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \Zend\Mvc\Controller\AbstractActionController::indexAction()
     */
    public function indexAction()
    {
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
                $this->getEventManager()->trigger('productCreate', $this, array(
                    'productEntity' => $productEntity,
                    'authId' => $this->identity()
                        ->getAuthId(),
                    'historyUrl' => $this->getRequest()
                        ->getUri()
                ));
                
                // set flash messenger
                $this->flashMessenger()->addSuccessMessage('Product was saved');
                
                // return
                return $this->redirect()->toRoute('product-index');
            }
        }
        
        $this->form->get('productId')->setValue(0);
        
        return new ViewModel(array(
            'form' => $this->form
        ));
    }
}
