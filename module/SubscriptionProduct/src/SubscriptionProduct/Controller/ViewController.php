<?php
namespace SubscriptionProduct\Controller;

use Application\Controller\BaseController;
use SubscriptionProduct\Service\SubscriptionProductServiceInterface;
use Zend\View\Model\ViewModel;
use Subscription\Service\SubscriptionServiceInterface;

class ViewController extends BaseController
{
    /**
     *
     * @var SubscriptionProductServiceInterface
     */
    protected $service;
    
    /**
     * 
     * @var SubscriptionServiceInterface
     */
    protected $subscriptionService;
    
    /**
     * 
     * @param SubscriptionProductServiceInterface $service
     * @param SubscriptionServiceInterface $subscriptionService
     */
    public function __construct(SubscriptionProductServiceInterface $service, SubscriptionServiceInterface $subscriptionService)
    {
        $this->service = $service;
        
        $this->subscriptionService = $subscriptionService;
    }
    
    /**
     *
     * {@inheritDoc}
     * @see \Zend\Mvc\Controller\AbstractActionController::indexAction()
     */
    public function indexAction()
    {
        $id = $this->params()->fromRoute('subscriptionProductId');
        
        $entity = $this->service->get($id);
        
        if(! $entity) {
            $this->flashMessenger()->addErrorMessage('Subscription Product not found');
            
            return $this->redirect()->toRoute('subscription-index', array('clientId' => $this->clientId));
        }
        
        $subscriptionEntity = $this->subscriptionService->get($entity->getSubscriptionId());
        
        // trigger event
        $this->getEventManager()->trigger('subscriptionProductView', $this, array(
            'authId' => $this->identity()->getAuthId(),
            'historyUrl' => $this->getRequest()->getUri(),
            'subscriptionProductEntity' => $entity,
        ));
        
        return new ViewModel(array(
            'entity' => $entity,
            'subscriptionEntity' => $subscriptionEntity
        ));
    }
}

