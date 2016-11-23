<?php
namespace Subscription\Controller;

use Application\Controller\BaseController;
use Subscription\Service\SubscriptionServiceInterface;
use Zend\View\Model\ViewModel;

class DeleteController extends BaseController
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
     * @see \Zend\Mvc\Controller\AbstractActionController::indexAction()
     */
    public function indexAction()
    {
        
        
        return new ViewModel(array(
            
        ));
    }
}