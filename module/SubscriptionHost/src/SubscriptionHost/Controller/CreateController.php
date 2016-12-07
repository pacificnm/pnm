<?php
namespace SubscriptionHost\Controller;

use SubscriptionHost\Service\SubscriptionHostServiceInterface;
use SubscriptionHost\Form\SubscriptionHostForm;
use Zend\View\Model\ViewModel;
use Client\Controller\ClientBaseController;

class CreateController extends ClientBaseController
{
    /**
     *
     * @var SubscriptionHostServiceInterface
     */
    protected $service;
    
    /**
     *
     * @var SubscriptionHostForm
     */
    protected $form;
    
    /**
     *
     * @param SubscriptionHostServiceInterface $service
     * @param SubscriptionHostForm $form
     */
    public function __construct(SubscriptionHostServiceInterface $service, SubscriptionHostForm $form)
    {
        $this->service = $service;
    
        $this->form = $form;
    }
    
    /**
     *
     * @return \Zend\View\Model\ViewModel
     */
    public function indexAction()
    {
        parent::indexAction();
        
        $request = $this->getRequest();
                
        $subscriptionId = $this->params()->fromRoute('subscriptionId');
        
        // set form values
        $this->form->getClientHosts($this->clientId);
        
        $this->form->get('subscriptionId')->setValue($subscriptionId);
        
        $this->form->get('subscriptionHostId')->setValue(0);
        
        $this->form->get('subscriptionHostCreated')->setValue(time());
        
        // if we have a post
        if ($request->isPost()) {
        
            $postData = $request->getPost();
        
            $this->form->setData($postData);
        
            // if the form is valid
            if ($this->form->isValid()) {
        
                $entity = $this->form->getData();
        
                $subscriptionHostEntity = $this->service->save($entity);
        
                // trigger event
                $this->getEventManager()->trigger('subscriptionHostCreate', $this, array(
                    'authId' => $this->identity()->getAuthId(),
                    'historyUrl' => $this->getRequest()->getUri(),
                    'subscriptionHostEntity' => $subscriptionHostEntity,
                ));
        
                // set flash messenger
                $this->flashMessenger()->addSuccessMessage('Host was added to subscription');
        
                return $this->redirect()->toRoute('subscription-view', array(
                    'clientId' => $this->clientId,
                    'subscriptionId' => $subscriptionId
                ));
            }
        }
        
        // return view model
        return new ViewModel(array(
            'form' => $this->form
        ));
    }
}

