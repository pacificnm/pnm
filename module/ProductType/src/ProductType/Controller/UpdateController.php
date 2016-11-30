<?php
namespace ProductType\Controller;

use Application\Controller\BaseController;
use Zend\View\Model\ViewModel;
use ProductType\Service\ProductTypeServiceInterface;
use ProductType\Form\ProductTypeForm;

class UpdateController extends BaseController
{

    /**
     *
     * @var ProductTypeServiceInterface
     */
    protected $service;

    /**
     *
     * @var ProductTypeForm
     */
    protected $form;

    /**
     * 
     * @param ProductTypeServiceInterface $service
     * @param ProductTypeForm $form
     */
    public function __construct(ProductTypeServiceInterface $service, ProductTypeForm $form)
    {
        $this->service = $service;
        
        $this->form = $form;
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
        
            $postData = $request->getPost();
        
            $this->form->setData($postData);
        
            // if the form is valid
            if ($this->form->isValid()) {
                $entity = $this->form->getData();
        
                $productTypeEntity = $this->service->save($entity);
                
                // trigger event
                $this->getEventManager()->trigger('productTypeUpdate', $this, array(
                    'authId' => $this->identity()->getAuthId(),
                    'historyUrl' => $this->getRequest()->getUri(),
                    'productTypeEntity' => $productTypeEntity,
                ));
                
                // set flash messenger
                $this->flashMessenger()->addSuccessMessage('Product type was saved');
                
                // return
                return $this->redirect()->toRoute('product-type-view', array('productTypeId' => $id));
            }
        }
        
        // bind data to form
        $this->form->bind($entity);
        
        // return view model
        return new ViewModel(array(
            'form' => $this->form
        ));
    }
}

