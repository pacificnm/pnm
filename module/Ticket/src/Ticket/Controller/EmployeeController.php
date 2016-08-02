<?php
namespace Ticket\Controller;

use Application\Controller\BaseController;
use Ticket\Service\TicketServiceInterface;
use Ticket\Form\EmployeeForm;
use Zend\View\Model\ViewModel;

class EmployeeController extends BaseController
{

    /**
     *
     * @var EmployeeForm
     */
    protected $form;

    /**
     *
     * @param TicketServiceInterface $ticketService            
     * @param EmployeeForm $form            
     */
    public function __construct(TicketServiceInterface $ticketService, EmployeeForm $form)
    {
        $this->ticketService = $ticketService;
        
        $this->form = $form;
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \Zend\Mvc\Controller\AbstractActionController::indexAction()
     */
    public function indexAction()
    {
        $clientId = $this->params()->fromRoute('clientId');
        
        $ticketId = $this->params()->fromRoute('ticketId');
        
        $request = $this->getRequest();
        
        $clientEntity = $this->getClient($clientId);
        
        $ticketEntity = $this->ticketService->get($ticketId);
        
        // if we have a post
        if ($request->isPost()) {
            
            // get post
            $postData = $request->getPost();
            
            $this->form->setData($postData);
            
            // if we are valid
            if ($this->form->isValid()) {
                
                // get hydrated form results
                $entity = $this->form->getData();
                
                $ticketEntity = $this->ticketService->save($entity);
                
                // @todo complete history for ticket
                $this->SetTicketHistory($request->getUri(), CREATE, $this->identity()
                    ->getAuthId(), 'Ticket was updated', $ticketEntity->getTicketId());
                
                $this->flashMessenger()->addSuccessMessage('The support ticket was saved.');
                
                return $this->redirect()->toRoute('ticket-view', array(
                    'clientId' => $clientId,
                    'ticketId' => $ticketEntity->getTicketId()
                ));
            }
        }
        
        // bind to form
        $this->form->bind($ticketEntity);
        
        // set layout up
        $this->layout()->setVariable('pageSubTitle', $clientEntity->getClientName());
        
        $this->layout()->setVariable('activeMenuItem', 'client');
        
        $this->layout()->setVariable('activeSubMenuItem', 'ticket-index');
        
        // return view model
        return new ViewModel(array(
            'ticketEntity' => $ticketEntity,
            'clientEntity' => $clientEntity,
            'clientId' => $clientId,
            'ticketId' => $ticketId,
            'form' => $this->form
        ));
    }
}

