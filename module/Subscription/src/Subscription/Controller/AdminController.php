<?php
namespace Subscription\Controller;

use Application\Controller\BaseController;
use Subscription\Service\SubscriptionServiceInterface;

class AdminController extends BaseController
{
    protected $subscriptionService;
    
    public function __construct(SubscriptionServiceInterface $subscriptionService)
    {
        $this->subscriptionService = $subscriptionService;
    }
    
    public function indexAction()
    {
        
    }
}

?>