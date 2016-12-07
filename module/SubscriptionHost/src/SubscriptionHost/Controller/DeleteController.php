<?php
namespace SubscriptionHost\Controller;

use Client\Controller\ClientBaseController;
use Zend\View\Model\ViewModel;
use SubscriptionHost\Service\SubscriptionHostServiceInterface;

class DeleteController extends ClientBaseController
{

    /**
     *
     * @var SubscriptionHostServiceInterface
     */
    protected $service;

    /**
     *
     * @param SubscriptionHostServiceInterface $service            
     */
    public function __construct(SubscriptionHostServiceInterface $service)
    {
        $this->service = $service;
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \Client\Controller\ClientBaseController::indexAction()
     */
    public function indexAction()
    {
        parent::indexAction();
        
        $request = $this->getRequest();
        
        $subscriptionId = $this->params()->fromRoute('subscriptionId');
        
        $id = $this->params()->fromRoute('subscriptionHostId');
        
        $entity = $this->service->get($id);
        
        // validate we have an entity
        if (! $entity) {
            $this->flashMessenger()->addErrorMessage('Host not found');
            
            return $this->redirect()->toRoute('subscription-view', array(
                'clientId' => $this->clientId,
                'subscriptionId' => $subscriptionId
            ));
        }
        
        // if we have a post
        if ($request->isPost()) {
            $del = $request->getPost('delete_confirmation', 'no');
            
            // if yes
            if ($del === 'yes') {
                
                $this->service->delete($entity);
                
                // trigger event
                $this->getEventManager()->trigger('subscriptionHostDelete', $this, array(
                    'authId' => $this->identity()->getAuthId(),
                    'historyUrl' => $this->getRequest()->getUri(),
                    'subscriptionHostEntity' => $entity
                ));
                
                $this->flashMessenger()->addSuccessMessage('Host was removed from subscription');
            }
            
            // return redirect
            return $this->redirect()->toRoute('subscription-view', array(
                'clientId' => $this->clientId,
                'subscriptionId' => $subscriptionId
            ));
        }
        
        // return view model
        return new ViewModel(array(
            'entity' => $entity
        ));
    }
}