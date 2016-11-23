<?php
namespace SubscriptionHost\Controller;

use Client\Controller\ClientBaseController;
use Zend\View\Model\ViewModel;
use SubscriptionHost\Service\SubscriptionHostServiceInterface;

class DeleteController extends ClientBaseController
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
     * {@inheritDoc}
     * @see \Client\Controller\ClientBaseController::indexAction()
     */
    public function indexAction()
    {
        parent::indexAction();
        
        return new ViewModel(array(
            
        ));
    }
}