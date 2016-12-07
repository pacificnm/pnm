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
    protected $service;
    
    /**
     * 
     * @param SubscriptionServiceInterface $subscriptionService
     */
    public function __construct(SubscriptionServiceInterface $service)
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
        $filter = array();
        
        // get paginator
        $paginator = $this->service->getAll($filter);
        
        $paginator->setCurrentPageNumber($this->page);
        
        $paginator->setItemCountPerPage($this->countPerPage);
        
        // trigger event
        $this->getEventManager()->trigger('subscriptionAdminIndex', $this, array(
            'authId' => $this->identity()->getAuthId(),
            'historyUrl' => $this->getRequest()->getUri()
        ));
        
        // return view model
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
