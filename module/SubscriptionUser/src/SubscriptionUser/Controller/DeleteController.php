<?php
namespace SubscriptionUser\Controller;

use Client\Controller\ClientBaseController;
use Zend\View\Model\ViewModel;
use SubscriptionUser\Service\SubscriptionUserServiceInterface;

class DeleteController extends ClientBaseController
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
    
    /**
     * 
     * {@inheritDoc}
     * @see \Client\Controller\ClientBaseController::indexAction()
     */
    public function indexAction()
    {
        parent::indexAction();
        
        return new ViewModel(array());
    }
}

