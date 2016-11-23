<?php
namespace Subscription\Controller;

use Application\Controller\BaseController;
use Subscription\Service\SubscriptionServiceInterface;
use Zend\View\Model\ViewModel;

class AdminController extends BaseController
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
     * @see \Zend\Mvc\Controller\AbstractActionController::indexAction()
     */
    public function indexAction()
    {
        $filter = array();
        
        // get paginator
        $paginator = $this->subscriptionService->getAll($filter);
        
        $paginator->setCurrentPageNumber($this->page);
        
        $paginator->setItemCountPerPage($this->countPerPage);
        
        return new ViewModel(array(
            'paginator' => $paginator,
            'page' => $this->page,
            'itemCount' => $paginator->getTotalItemCount(),
            'pageCount' => $paginator->count(),
            'queryParams' => $this->params()->fromQuery(),
            'routeParams' => array()
        ));
    }
}
