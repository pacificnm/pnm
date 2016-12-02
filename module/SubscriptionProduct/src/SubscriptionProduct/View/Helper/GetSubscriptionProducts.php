<?php
namespace SubscriptionProduct\View\Helper;

use Zend\View\Helper\AbstractHelper;
use SubscriptionProduct\Service\SubscriptionProductServiceInterface;
use Subscription\Service\SubscriptionServiceInterface;

class GetSubscriptionProducts extends AbstractHelper
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
     * @param number $subscriptionId
     */
    public function __invoke($subscriptionId)
    {
        $view = $this->getView();
        
        $partialHelper = $view->plugin('partial');
        
        $data = new \stdClass();
        
        $filter = array(
            'subscriptionId' => $subscriptionId
        );
        
        $entitys = $this->service->getAll($filter);
        
        $subscriptionEntity = $this->subscriptionService->get($subscriptionId);
        
        $data->entitys = $entitys;
        
        $data->subscriptionEntity = $subscriptionEntity;
        
        return $partialHelper('partials/get-subscription-products.phtml', $data);
    }
    
    
}

