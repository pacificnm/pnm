<?php
namespace Subscription\Controller;

use Subscription\Service\SubscriptionServiceInterface;
use Subscription\Form\SubscriptionForm;
use Zend\View\Model\ViewModel;
use Client\Controller\ClientBaseController;

class CreateController extends ClientBaseController
{

    /**
     *
     * @var SubscriptionServiceInterface
     */
    protected $service;

    /**
     *
     * @var SubscriptionForm
     */
    protected $form;

    /**
     * 
     * @param SubscriptionServiceInterface $service
     * @param SubscriptionForm $form
     */
    public function __construct(SubscriptionServiceInterface $service, SubscriptionForm $form)
    {
        $this->service = $service;
        
        $this->form = $form;
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \Zend\Mvc\Controller\AbstractActionController::indexAction()
     */
    public function indexAction()
    {
        parent::indexAction();
        
        $request = $this->getRequest();
        
        // if we have a post
        if ($request->isPost()) {
            
            $postData = $request->getPost();
            
            $this->form->setData($postData);
            
            // if the form is valid
            if ($this->form->isValid()) {
                
                $entity = $this->form->getData();
                
               
                $entity->setSubscriptionDateDue(strtotime($entity->getSubscriptionDateDue()));
                
                $entity->setSubscriptionDateEnd(strtotime($entity->getSubscriptionDateEnd()));
                
                // save
                $subscriptionEntity = $this->service->save($entity);
                
                // trigger event
                $this->getEventManager()->trigger('subscriptionCreate', $this, array(
                    'authId' => $this->identity()->getAuthId(),
                    'historyUrl' => $this->getRequest()->getUri(),
                    'subscriptionEntity' => $subscriptionEntity,
                ));
                
                
                // set flash messenger
                $this->flashMessenger()->addSuccessMessage('Subscription saved');
                
                return $this->redirect()->toRoute('subscription-view', array(
                    'clientId' => $this->clientId,
                    'subscriptionId' => $subscriptionEntity->getSubscriptionId()
                ));
            }
        }
        
        // set form defaults
        $this->form->get('subscriptionId')->setValue(0);
        
        $this->form->get('clientId')->setValue($this->clientId);
        
        $this->form->get('subscriptionDateCreate')->setValue(time());
        
        $this->form->get('subscriptionDateUpdate')->setValue(time());
        
        // return view model
        return new ViewModel(array(
            'form' => $this->form
        ));
    }
}