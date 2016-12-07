<?php
namespace SubscriptionUser\Controller;

use Client\Controller\ClientBaseController;
use SubscriptionUser\Service\SubscriptionUserServiceInterface;
use Zend\View\Model\ViewModel;
use SubscriptionUser\Form\SubscriptionUserForm;

class CreateController extends ClientBaseController
{
    /**
     * 
     * @var SubscriptionUserServiceInterface
     */
    protected $service;
    
    /**
     * 
     * @var SubscriptionUserForm
     */
    protected $form;
    
    /**
     * 
     * @param SubscriptionUserServiceInterface $service
     * @param SubscriptionUserForm $form
     */
    public function __construct(SubscriptionUserServiceInterface $service, SubscriptionUserForm $form)
    {
        $this->service = $service;
        
        $this->form = $form;
    }
    
    /**
     * 
     * {@inheritDoc}
     * @see \Client\Controller\ClientBaseController::indexAction()
     */
    public function indexAction()
    {
        parent::indexAction();
        
        $request = $this->getRequest();
        
        $subscriptionId = $this->params()->fromRoute('subscriptionId');
        
        $this->form->getClientUsers($this->clientId);
        
        $this->form->get('subscriptionId')->setValue($subscriptionId);
        
        $this->form->get('subscriptionUserCreate')->setValue(time());
        
        $this->form->get('subscriptionUserId')->setValue(0);
        
        // if we have a post
        if ($request->isPost()) {
        
            $postData = $request->getPost();
        
            $this->form->setData($postData);
        
            // if the form is valid
            if ($this->form->isValid()) {
        
                $entity = $this->form->getData();
        
                $subscriptionUserEntity = $this->service->save($entity);
        
                // trigger event
                $this->getEventManager()->trigger('subscriptionUserCreate', $this, array(
                    'authId' => $this->identity()->getAuthId(),
                    'historyUrl' => $this->getRequest()->getUri(),
                    'subscriptionUserEntity' => $subscriptionUserEntity,
                ));
        
                // set flash messenger
                $this->flashMessenger()->addSuccessMessage('User was added to subscription');
        
                return $this->redirect()->toRoute('subscription-view', array(
                    'clientId' => $this->clientId,
                    'subscriptionId' => $subscriptionId
                ));
            }
        }
        
        return new ViewModel(array(
            'form' => $this->form
        ));
    }
}


