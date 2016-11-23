<?php
namespace Subscription\Controller;

use Subscription\Service\SubscriptionServiceInterface;
use Client\Controller\ClientBaseController;
use Zend\View\Model\ViewModel;

class IndexController extends ClientBaseController
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
     * @see \Client\Controller\ClientBaseController::indexAction()
     */
    public function indexAction()
    {
        parent::indexAction();
        
        $filter = array(
            'clientId' => $this->clientId
        );
        
        // get paginator
        $paginator = $this->subscriptionService->getAll($filter);
        
        $paginator->setCurrentPageNumber($this->page);
        
        $paginator->setItemCountPerPage($this->countPerPage);
        
        // return view model
        return new ViewModel(array(
            'clientId' => $this->clientId,
            'paginator' => $paginator,
            'page' => $this->page,
            'itemCount' => $paginator->getTotalItemCount(),
            'pageCount' => $paginator->count(),
            'queryParams' => $this->params()->fromQuery(),
            'routeParams' => array()
        ));
    }
}