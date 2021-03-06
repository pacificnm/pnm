<?php
namespace SubscriptionProduct\Controller;

use Application\Controller\BaseController;
use Zend\View\Model\ViewModel;
use SubscriptionProduct\Service\SubscriptionProductServiceInterface;
use SubscriptionProduct\Form\SubscriptionProductForm;

class UpdateController extends BaseController
{
    /**
     *
     * @var SubscriptionProductServiceInterface
     */
    protected $service;
    
    /**
     *
     * @var SubscriptionProductForm
     */
    protected $form;
    
    /**
     *
     * @param SubscriptionProductServiceInterface $service
     * @param SubscriptionProductForm $form
     */
    public function __construct(SubscriptionProductServiceInterface $service, SubscriptionProductForm $form)
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
        
        $subscriptionId = $this->params()->fromRoute('subscriptionId');
        
        $id = $this->params()->fromRoute('subscriptionProductId');
        
        $clientId = $this->params()->fromRoute('clientId');
        
        $entity = $this->service->get($id);
        
        if(! $entity) {
            $this->flashMessenger()->addErrorMessage('Subscription product not found');
            
            return $this->redirect()->toRoute('subscription-product-index', array('clientId' => $clientId));
        }
        
        // if we have a post
        if ($request->isPost()) {
        
            $postData = $request->getPost();
        
            $this->form->setData($postData);
        
            // if the form is valid
            if ($this->form->isValid()) {
        
                $entity = $this->form->getData();
        
                $subscriptionProductEntity = $this->service->save($entity);
        
                // trigger event
                $this->getEventManager()->trigger('subscriptionProductUpdate', $this, array(
                    'authId' => $this->identity()->getAuthId(),
                    'historyUrl' => $this->getRequest()->getUri(),
                    'subscriptionProductEntity' => $subscriptionProductEntity,
                ));
        
                // set flash messenger
                $this->flashMessenger()->addSuccessMessage('Subscription product saved');
        
                return $this->redirect()->toRoute('subscription-view', array(
                    'clientId' => $this->clientId,
                    'subscriptionId' => $subscriptionId
                ));
            }
        }
        
        // bind form
        $this->form->bind($entity);
        
        return new ViewModel(array(
            'form' => $this->form
        ));
    }
}

