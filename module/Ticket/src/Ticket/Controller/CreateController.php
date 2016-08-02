<?php
namespace Ticket\Controller;

use Application\Controller\BaseController;
use Ticket\Service\TicketServiceInterface;
use Ticket\Form\UserForm;
use Zend\View\Model\ViewModel;

class CreateController extends BaseController
{


    /**
     *
     * @var TicketServiceInterface
     */
    protected $ticketService;

    /**
     *
     * @var UserForm
     */
    protected $userForm;

    
    public function __construct(TicketServiceInterface $ticketService, UserForm $userForm)
    {   
        $this->ticketService = $ticketService;
        
        $this->userForm = $userForm;
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
        
        $request = $this->getRequest();
        
        // @todo refactor user from identity to userId
        $userId = $this->identity()->getUser();
        
        // get the client entity
        $clientEntity = $this->getClient($clientId);
        
        if ($request->isPost()) {
            
            // get post
            $postData = $request->getPost();
            
            $this->userForm->setData($postData);
            
            // if we are valid
            if ($this->userForm->isValid()) {
                
                // get hydrated form results
                $entity = $this->userForm->getData();
 
                $ticketEntity = $this->ticketService->save($entity);              
                
                // @todo email employees
                
                // @todo complete history for ticket
                $this->SetTicketHistory($request->getUri(), 'CREATE', $this->identity()
                    ->getAuthId(), 'Ticket was created', $ticketEntity->getTicketId());
                
                $this->flashMessenger()->addSuccessMessage('Your support ticket was saved and our staff have been notified.');
                
                return $this->redirect()->toRoute('ticket-view', array(
                    'clientId' => $clientId,
                    'ticketId' => $ticketEntity->getTicketId()
                ));
            }   
        }
        
        // set some defaults
        $this->userForm->get('ticketId')->setValue(0);
        
        $this->userForm->get('userId')->setValue($userId);
        
        $this->userForm->get('clientId')->setValue($clientId);
        
        $this->userForm->get('ticketStatus')->setValue('New');
        
        $this->userForm->get('ticketDateOpen')->setValue(time());
        
        $this->userForm->get('ticketDateClose')->setValue(0);
        
        // set layout up
        $this->layout()->setVariable('pageSubTitle', $this->identity()
            ->getAuthName());
        
        $this->layout()->setVariable('activeMenuItem', 'user');
        
        $this->layout()->setVariable('activeSubMenuItem', 'ticket-create');
        
        // return view model
        return new ViewModel(array(
            'clientId' => $clientId,
            'clientEntity' => $clientEntity,
            'form' => $this->userForm
        ));
    }
}

