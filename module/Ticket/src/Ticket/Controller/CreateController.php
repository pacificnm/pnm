<?php
namespace Ticket\Controller;

use Ticket\Service\TicketServiceInterface;
use Ticket\Form\UserForm;
use Zend\View\Model\ViewModel;
use Client\Controller\ClientBaseController;

class CreateController extends ClientBaseController
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

    /**
     *
     * @param TicketServiceInterface $ticketService            
     * @param UserForm $userForm            
     */
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
        $request = $this->getRequest();
        
        $userId = $this->identity()->getUserId();
        
        // if we have a post
        if ($request->isPost()) {
            
            // get post
            $postData = $request->getPost();
            
            $this->userForm->setData($postData);
            
            // if we are valid
            if ($this->userForm->isValid()) {
                
                // get hydrated form results
                $entity = $this->userForm->getData();
                
                // save ticket
                $ticketEntity = $this->ticketService->save($entity);
                
                // trigger event
                $this->getEventManager()->trigger('ticketCreate', $this, array(
                    'ticketEntity' => $ticketEntity,
                    'authId' => $this->identity()
                        ->getAuthId(),
                    'historyUrl' => $this->getRequest()
                        ->getUri()
                ));
                
                // set flash message
                $this->flashMessenger()->addSuccessMessage('Your support ticket was saved and our staff have been notified.');
                
                // return to ticket view
                return $this->redirect()->toRoute('ticket-view', array(
                    'clientId' => $this->clientId,
                    'ticketId' => $ticketEntity->getTicketId()
                ));
            }
        }
        
        // set some defaults
        $this->userForm->get('ticketId')->setValue(0);
        
        $this->userForm->get('userId')->setValue($userId);
        
        $this->userForm->get('clientId')->setValue($this->clientId);
        
        $this->userForm->get('ticketStatus')->setValue('New');
        
        $this->userForm->get('ticketDateOpen')->setValue(time());
        
        $this->userForm->get('ticketDateClose')->setValue(0);
        
        // return view model
        return new ViewModel(array(
            'clientId' => $this->clientId,
            'clientEntity' => $this->clientEntity,
            'form' => $this->userForm
        ));
    }
}

