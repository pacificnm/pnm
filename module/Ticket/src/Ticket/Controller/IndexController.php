<?php
namespace Ticket\Controller;

use Application\Controller\BaseController;
use Ticket\Service\TicketServiceInterface;
use Zend\View\Model\ViewModel;

class IndexController extends BaseController
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
     * @see \Zend\Mvc\Controller\AbstractActionController::indexAction()
     */
    public function indexAction()
    {
        $clientId = $this->params()->fromRoute('clientId');
        
        $ticketStatus = $this->params()->fromQuery('ticketStatus', null);
        
        $page = $this->params()->fromQuery('page', 1);
        
        $countPerPage = $this->params()->fromQuery('count-per-page', 25);
        
        // get client
        $clientEntity = $this->getClient($clientId);
        
        
        $filter = array(
            'clientId' => $clientId,
            'ticketStatus' => $ticketStatus
        );
        
        $paginator = $this->ticketService->getAll($filter);
        
        $paginator->setCurrentPageNumber($page);
        
        $paginator->setItemCountPerPage($countPerPage);
        
        // set layout up
        $this->layout()->setVariable('pageTitle', 'Support Tickets');
        
        $this->layout()->setVariable('pageSubTitle', $clientEntity->getClientName());
        
        $this->layout()->setVariable('activeMenuItem', 'client');
        
        $this->layout()->setVariable('activeSubMenuItem', 'ticket-index');
        
        return new ViewModel(array(
            'clientId' => $clientId,
            'paginator' => $paginator,
            'page' => $page,
            'itemCount' => $paginator->getTotalItemCount(),
            'pageCount' => $paginator->count(),
            'queryParams' => $this->params()->fromQuery(),
            'routeParams' => array(
                'clientId' => $clientId
            ),
            'ticketStatus' => $ticketStatus
        ));
    }
}

