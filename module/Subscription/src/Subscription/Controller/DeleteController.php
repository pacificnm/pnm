<?php
namespace Subscription\Controller;

use Subscription\Service\SubscriptionServiceInterface;
use Zend\View\Model\ViewModel;
use Client\Controller\ClientBaseController;

class DeleteController extends ClientBaseController
{

    /**
     *
     * @var SubscriptionServiceInterface
     */
    protected $service;

    /**
     *
     * @param SubscriptionServiceInterface $subscriptionService            
     */
    public function __construct(SubscriptionServiceInterface $service)
    {
        $this->service = $service;
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
        
        $id = $this->params('subscriptionId');
                
        $entity = $this->service->get($id);
        
        if (! $entity) {
            $this->flashMessenger()->addErrorMessage('Subscription not found');
        
            return $this->redirect()->toRoute('subscription-index', array(
                'clientId' => $this->clientId
            ));
        }
        
        // if we have a post
        if ($request->isPost()) {
            $del = $request->getPost('delete_confirmation', 'no');
        
            if ($del === 'yes') {
                $this->service->delete($entity);
        
                // trigger event
                $this->getEventManager()->trigger('subscriptionDelete', $this, array(
                    'authId' => $this->identity()->getAuthId(),
                    'historyUrl' => $this->getRequest()->getUri(),
                    'subscriptionEntity' => $entity,
                ));
        
                $this->flashMessenger()->addSuccessMessage('Subscription was deleted');
        
                return $this->redirect()->toRoute('subscription-index', array('clientId' => $this->clientId));
            }
        
            return $this->redirect()->toRoute('subscription-view', array('clientId' => $this->clientId, 'subscriptionId' => $id));
        }
        
        // return view model
        return new ViewModel(array(
            'entity' => $entity
        ));
    }
}