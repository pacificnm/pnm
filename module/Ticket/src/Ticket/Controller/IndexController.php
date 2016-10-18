<?php
namespace Ticket\Controller;

use Ticket\Service\TicketServiceInterface;
use Zend\View\Model\ViewModel;
use Client\Controller\ClientBaseController;

class IndexController extends ClientBaseController
{

    /**
     *
     * @var TicketServiceInterface
     */
    protected $ticketService;

    /**
     *
     * @param TicketServiceInterface $ticketService            
     */
    public function __construct(TicketServiceInterface $ticketService)
    {
        $this->ticketService = $ticketService;
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \Zend\Mvc\Controller\AbstractActionController::indexAction()
     */
    public function indexAction()
    {
        parent::indexAction();
        
        $ticketStatus = $this->params()->fromQuery('ticketStatus', null);
        
        // create filter
        $filter = array(
            'clientId' => $this->clientId,
            'ticketStatus' => $ticketStatus
        );
        
        // get paginator
        $paginator = $this->ticketService->getAll($filter);
        
        $paginator->setCurrentPageNumber($this->page);
        
        $paginator->setItemCountPerPage($this->countPerPage);
        
        // return view
        return new ViewModel(array(
            'clientId' => $this->clientId,
            'paginator' => $paginator,
            'page' => $this->page,
            'count-per-page' => $this->countPerPage,
            'itemCount' => $paginator->getTotalItemCount(),
            'pageCount' => $paginator->count(),
            'queryParams' => $this->params()->fromQuery(),
            'routeParams' => array(
                'clientId' => $this->clientId
            ),
            'ticketStatus' => $ticketStatus
        ));
    }
}

