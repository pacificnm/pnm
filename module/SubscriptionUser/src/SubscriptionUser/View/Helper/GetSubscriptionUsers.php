<?php
namespace SubscriptionUser\View\Helper;



use Zend\View\Helper\AbstractHelper;
use SubscriptionUser\Service\SubscriptionUserServiceInterface;

class GetSubscriptionUsers extends AbstractHelper
{
    /**
     * 
     * @var SubscriptionUserServiceInterface
     */
    protected $service;

    /**
     * 
     * @param SubscriptionUserServiceInterface $service
     */
    public function __construct(SubscriptionUserServiceInterface $service)
    {
        $this->service = $service;
    }
    
    public function __invoke($subscriptionId)
    {
        $view = $this->getView();
        
        $partialHelper = $view->plugin('partial');
        
        $data = new \stdClass();
        
        $entitys = $this->service->getAll(array(
            'subscriptionId' => $subscriptionId,
            'pagination' => 'off'
        ));
        
        $data->entitys = $entitys;
        
        return $partialHelper('partials/get-subscription-users.phtml', $data);
    }
}

