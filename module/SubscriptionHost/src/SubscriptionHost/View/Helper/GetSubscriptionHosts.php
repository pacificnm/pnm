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
    protected $service;
    
    /**
     * 
     * @param SubscriptionHostServiceInterface $subscriptionHostService
     */
    public function __construct(SubscriptionHostServiceInterface $service)
    {
        $this->service = $service;
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
        
        $entitys = $this->service->getHostsSubscription($subscriptionId);
        
        $data->entitys = $entitys;
        
        return $partialHelper('partials/get-subscription-hosts.phtml', $data);
    }
}
