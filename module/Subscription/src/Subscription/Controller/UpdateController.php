<?php
namespace Subscription\Controller;

use Subscription\Service\SubscriptionServiceInterface;
use Subscription\Form\SubscriptionForm;
use Zend\View\Model\ViewModel;
use Client\Controller\ClientBaseController;

class UpdateController extends ClientBaseController
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
     * @param SubscriptionServiceInterface $subscriptionService            
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
        $request = $this->getRequest();
        
        $id = $this->params()->fromRoute('subscriptionId');
        
        $entity = $this->service->get($id);
        
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
                $this->getEventManager()->trigger('subscriptionUpdate', $this, array(
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
        
        $this->form->bind($entity);
        
        $this->form->get('subscriptionDateDue')->setValue(date("m/d/Y", $entity->getSubscriptionDateDue()));
        
        $this->form->get('subscriptionDateEnd')->setValue(date("m/d/Y", $entity->getSubscriptionDateEnd()));
        
        return new ViewModel(array(
            'form' => $this->form
        ));
    }
}