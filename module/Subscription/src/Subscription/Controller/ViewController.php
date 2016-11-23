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
    protected $subscriptionService;

    /**
     *
     * @param SubscriptionServiceInterface $subscriptionService            
     */
    public function __construct(SubscriptionServiceInterface $subscriptionService)
    {
        $this->subscriptionService = $subscriptionService;
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \Client\Controller\ClientBaseController::indexAction()
     */
    public function indexAction()
    {
        $subsciptionId = $this->params('subscriptionId');
        
        $subscriptionEntity = $this->subscriptionService->get($subsciptionId);
        
        if (! $subscriptionEntity) {
            $this->flashMessenger()->addErrorMessage('Subscription not found');
            
            return $this->redirect()->toRoute('subscription-index', array(
                'clientId' => $this->clientId
            ));
        }
        
        // trigger even
        $this->getEventManager()->trigger('subscriptionView', $this, array(
            'subscriptionEntity' => $subscriptionEntity,
            'authId' => $this->identity()
                ->getAuthId(),
            'historyUrl' => $this->getRequest()
                ->getUri()
        ));
        
        // return view model
        return new ViewModel(array(
            'subscriptionEntity' => $subscriptionEntity
        ));
    }
}