<?php
namespace SubscriptionHost\View\Helper;

use Zend\View\Helper\AbstractHelper;
use SubscriptionHost\Service\SubscriptionHostServiceInterface;

class GetSubscriptionHosts extends AbstractHelper
{
    /**
     * 
     * @var SubscriptionHostServiceInterface
     */
    protected $subscriptionHostService;
    
    /**
     * 
     * @param SubscriptionHostServiceInterface $subscriptionHostService
     */
    public function __construct(SubscriptionHostServiceInterface $subscriptionHostService)
    {
        $this->subscriptionHostService = $subscriptionHostService;
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
        
        $subscriptionHostEntitys = $this->subscriptionHostService->getHostsSubscription($subscriptionId);
        
        $data->subscriptionHostEntitys = $subscriptionHostEntitys;
        
        return $partialHelper('partials/subscription-hosts.phtml', $data);
    }
}
