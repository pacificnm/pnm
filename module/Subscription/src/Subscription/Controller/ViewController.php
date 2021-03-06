<?php
namespace Subscription\Controller;

use Subscription\Service\SubscriptionServiceInterface;
use Client\Controller\ClientBaseController;
use Zend\View\Model\ViewModel;

class ViewController extends ClientBaseController
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
     * @see \Client\Controller\ClientBaseController::indexAction()
     */
    public function indexAction()
    {
        parent::indexAction();
        
        $id = $this->params('subscriptionId');
        
        $entity = $this->service->get($id);
        
        // validate entity
        if (! $entity) {
            $this->flashMessenger()->addErrorMessage('Subscription not found');
            
            return $this->redirect()->toRoute('subscription-index', array(
                'clientId' => $this->clientId
            ));
        }
        
        // trigger even
        $this->getEventManager()->trigger('subscriptionView', $this, array(
            'authId' => $this->identity()->getAuthId(),
            'historyUrl' => $this->getRequest()->getUri(),
            'subscriptionEntity' => $entity,
        ));
        
        // return view model
        return new ViewModel(array(
            'entity' => $entity
        ));
    }
}