<?php
namespace Subscription\Controller;

use Application\Controller\BaseController;
use Subscription\Service\SubscriptionServiceInterface;
use Subscription\Form\SubscriptionForm;
use Zend\View\Model\ViewModel;

class UpdateController extends BaseController
{

    /**
     *
     * @var SubscriptionServiceInterface
     */
    protected $subscriptionService;

    /**
     *
     * @var SubscriptionForm
     */
    protected $form;

    /**
     *
     * @param SubscriptionServiceInterface $subscriptionService            
     * @param SubscriptionForm $form            
     */
    public function __construct(SubscriptionServiceInterface $subscriptionService, SubscriptionForm $form)
    {
        $this->subscriptionService = $subscriptionService;
        
        $this->form = $form;
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