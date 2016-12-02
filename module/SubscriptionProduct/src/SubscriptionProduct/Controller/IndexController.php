<?php
namespace SubscriptionProduct\Controller;

use Application\Controller\BaseController;
use SubscriptionProduct\Service\SubscriptionProductServiceInterface;
use Zend\View\Model\ViewModel;

class IndexController extends BaseController
{
    /**
     *
     * @var SubscriptionProductServiceInterface
     */
    protected $service;
    
    /**
     *
     * @param SubscriptionProductServiceInterface $service
     */
    public function __construct(SubscriptionProductServiceInterface $service)
    {
        $this->service = $service;
    }
    
    /**
     *
     * {@inheritDoc}
     * @see \Zend\Mvc\Controller\AbstractActionController::indexAction()
     */
    public function indexAction()
    {
        return new ViewModel();
    }
}

