<?php
namespace SubscriptionProduct\Controller;

use Application\Controller\BaseController;
use SubscriptionProduct\Service\SubscriptionProductServiceInterface;
use Subscription\Service\SubscriptionServiceInterface;
use Zend\View\Model\ViewModel;

class DeleteController extends BaseController
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
     */
    public function __construct(SubscriptionProductServiceInterface $service, SubscriptionServiceInterface $subscriptionService)
    {
        $this->service = $service;
        
        $this->subscriptionService = $subscriptionService;
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
        
        $id = $this->params()->fromRoute('subscriptionProductId');
        
        $entity = $this->service->get($id);
        
        if (! $entity) {
            $this->flashMessenger()->addErrorMessage('Subscription Product not found');
            
            return $this->redirect()->toRoute('subscription-index', array(
                'clientId' => $this->clientId
            ));
        }
        
        $subscriptionEntity = $this->subscriptionService->get($entity->getSubscriptionId());
        
        // if we have a post
        if ($request->isPost()) {
            $del = $request->getPost('delete_confirmation', 'no');
            
            if ($del === 'yes') {
                $this->service->delete($entity);
                
                // trigger event
                $this->getEventManager()->trigger('subscriptionProductDelete', $this, array(
                    'authId' => $this->identity()->getAuthId(),
                    'historyUrl' => $this->getRequest()->getUri(),
                    'subscriptionProductEntity' => $entity
                ));
                
                $this->flashMessenger()->addSuccessMessage('The subscription product was deleted');
            }
            
            return $this->redirect()->toRoute('subscription-view', array(
                'clientId' => $subscriptionEntity->getClientId(),
                'subscriptionId' => $subscriptionEntity->getSubscriptionId()
            ));
        }
        
        return new ViewModel(array(
            'entity' => $entity,
            'subscriptionEntity' => $subscriptionEntity
        ));
    }
}

