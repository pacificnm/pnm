<?php
namespace Workorder\Controller;

use Application\Controller\BaseController;
use Zend\View\Model\ViewModel;
use Workorder\Service\WorkorderServiceInterface;
use Workorder\Form\WorkorderForm;
use WorkorderEmployee\Service\WorkorderEmployeeServiceInterface;
use WorkorderEmployee\Form\WorkorderEmployeeForm;
use Message\Service\MessageServiceInterface;
use Employee\Service\EmployeeServiceInterface;
use WorkorderCredit\Service\CreditServiceInterface;
use WorkorderCredit\Entity\CreditEntity;
use Ticket\Service\TicketServiceInterface;
use Zend\Form\Form;
use WorkorderTicket\Service\WorkorderTicketServiceInterface;

class CreateController extends BaseController
{

    /**
     *
     * @var WorkorderServiceInterface
     */
    protected $workorderService;

    /**
     *
     * @var WorkorderEmployeeServiceInterface
     */
    protected $workorderEmployeeService;


    /**
     *
     * @var MessageServiceInterface
     */
    protected $messageService;

    /**
     *
     * @var EmployeeServiceInterface
     */
    protected $employeeService;

    /**
     * 
     * @var CreditServiceInterface
     */
    protected $creditService;
    
    /**
     * 
     * @var TicketServiceInterface
     */
    protected $ticketService;
    
    /**
     * 
     * @var WorkorderTicketServiceInterface
     */
    protected $workorderTicketService;
    
    /**
     *
     * @var WorkorderForm
     */
    protected $workorderForm;

    /**
     *
     * @var WorkorderEmployeeForm
     */
    protected $workorderEmployeeForm;

    /**
     * 
     * @param WorkorderServiceInterface $workorderService
     * @param WorkorderEmployeeServiceInterface $workorderEmployeeService
     * @param MessageServiceInterface $messageService
     * @param EmployeeServiceInterface $employeeService
     * @param CreditServiceInterface $creditService
     * @param TicketServiceInterface $ticketService
     * @param WorkorderTicketServiceInterface $workorderTicketService
     * @param WorkorderForm $workorderForm
     * @param WorkorderEmployeeForm $workorderEmployeeForm
     */
    public function __construct(WorkorderServiceInterface $workorderService, WorkorderEmployeeServiceInterface $workorderEmployeeService, MessageServiceInterface $messageService, EmployeeServiceInterface $employeeService, CreditServiceInterface $creditService, TicketServiceInterface $ticketService, WorkorderTicketServiceInterface $workorderTicketService, WorkorderForm $workorderForm, WorkorderEmployeeForm $workorderEmployeeForm)
    {        
        $this->workorderService = $workorderService;
        
        $this->workorderEmployeeService = $workorderEmployeeService;
        
        $this->messageService = $messageService;
        
        $this->employeeService = $employeeService;
        
        $this->creditService = $creditService;
        
        $this->ticketService = $ticketService;
        
        $this->workorderTicketService = $workorderTicketService;
        
        $this->workorderForm = $workorderForm;
        
        $this->workorderEmployeeForm = $workorderEmployeeForm;
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \Zend\Mvc\Controller\AbstractActionController::indexAction()
     */
    public function indexAction()
    {
        $clientId = $this->params()->fromRoute('clientId');
        
        $ticketId = $this->params()->fromQuery('ticketId', null);
        
        $clientEntity = $this->getClient($clientId);
        
        $form = $this->workorderForm;
        
        $workorderEmployeeForm = $this->workorderEmployeeForm;
        
        $request = $this->getRequest();
        
        // if we have a post
        if ($request->isPost()) {
            
            // get post
            $postData = $request->getPost();
            
            $form->setData($postData);
            
            $workorderEmployeeForm->setData($postData);
                        
            // if we are valid
            if ($form->isValid() && $workorderEmployeeForm->isValid()) {
                
                $workorderEntity = $form->getData();
                
                $workorderEntity->setLocationId($postData['locationId']);
                
                // get employee data from form
                $workorderEmployeeEntity = $workorderEmployeeForm->getData();
                      
                // get the data from range and set start and stop dates
                $datePieces = explode('-', $postData['workorderDateScheduled']);
                
                // set dates
                $workorderEntity->setWorkorderDateScheduled(strtotime($datePieces[0]));
                
                $workorderEntity->setWorkorderDateEnd(strtotime($datePieces[1]));
                
                // save work order
                $workorderEntity = $this->workorderService->save($workorderEntity);
                
                // @todo move to event listeners for each module
                
                // save credit
                $this->saveCredit($clientId, $workorderEntity->getWorkorderId());
                
                // send employee messages
                $employeeEntity = $this->employeeService->get($workorderEmployeeEntity->getEmployeeId());
                
                $this->messageService->saveEmployeeWorkorder($workorderEntity, $employeeEntity);
                // @todo done
                
                // trigger callLogCreate event
                $this->getEventManager()->trigger('workorderCreate', $this, array(
                    'workorderEntity' => $workorderEntity,
                    'employeeEntity' => $workorderEmployeeEntity,
                    'clientEntity' => $workorderEntity->getClientEntity(),
                    'ticketId' => $ticketId,
                    'authId' => $this->identity()->getAuthId(),
                    'historyUrl' => $this->getRequest()->getUri()
                ));
                
                // set flash messenger
                $this->flashmessenger()->addSuccessMessage('The work order was saved.');
                
                // return to view the work order
                return $this->redirect()->toRoute('workorder-view', array(
                    'clientId' => $clientId,
                    'workorderId' => $workorderEntity->getWorkorderId()
                ));
            } 
        }
 
        $workorderEmployeeForm->get('workorderEmployeeId')->setValue(0);
        
        // set up layout
        $this->layout()->setVariable('clientId', $clientId);
        
        $this->layout()->setVariable('pageTitle', 'Create Work Order');
        
        $this->layout()->setVariable('pageSubTitle', $clientEntity->getClientName());
        
        $this->layout()->setVariable('activeMenuItem', 'client');
        
        $this->layout()->setVariable('activeSubMenuItem', 'workorder-list');
        
        $this->setHeadTitle($clientEntity->getClientName());
        
        // return View
        return new ViewModel(array(
            'clientEntity' => $clientEntity,
            'clientId' => $clientId,
            'form' =>  $this->setForm($form, $clientId, $ticketId),
            'workorderEmployeeForm' => $workorderEmployeeForm
        ));
    }
    
    
    /**
     * 
     * @param unknown $clientId
     * @param unknown $workorderId
     */
    protected function saveCredit($clientId, $workorderId)
    {
        // check if there is a credit balance if so map the balance
        $creditEntityBalance = $this->creditService->getWorkorderCreditBalance($clientId);
        
        if($creditEntityBalance && $creditEntityBalance->getWorkorderCreditAmountLeft() > 0) {
            
            $creditEntity = new CreditEntity();
        
            $creditEntity->setAccountId($creditEntityBalance->getAccountId());
            $creditEntity->setAccountLedgerId($creditEntityBalance->getAccountLedgerId());
            $creditEntity->setPaymentOptionId($creditEntityBalance->getPaymentOptionId());
            $creditEntity->setWorkorderCreditAmount($creditEntityBalance->getWorkorderCreditAmountLeft());
            $creditEntity->setWorkorderCreditAmountLeft($creditEntityBalance->getWorkorderCreditAmountLeft());
            $creditEntity->setWorkorderCreditDate($creditEntityBalance->getWorkorderCreditDate());
            $creditEntity->setWorkorderCreditDetail($creditEntityBalance->getWorkorderCreditDetail());
            $creditEntity->setWorkorderCreditId(0);
            $creditEntity->setWorkorderCreditType($creditEntityBalance->getWorkorderCreditType());
            
            $creditEntity->setWorkorderId($workorderId);
        
        
            $this->creditService->save($creditEntity);
        }
    }
    
    /**
     * 
     * @param unknown $form
     * @param unknown $clientId
     * @return unknown
     */
    protected function setForm(WorkorderForm $form, $clientId, $ticketId)
    {
        $form->setClientId($clientId);
        
        $form->getLocation();
        
        $form->get('workorderId')->setValue(0);
        
        $form->get('workorderParts')->setValue(0);
        
        $form->get('workorderLabor')->setValue(0);
        
        $form->get('clientId')->setValue($clientId);
        
        $form->get('workorderDateCreate')->setValue(time());
        
        $form->get('workorderDateEnd')->setValue(0);
        
        $form->get('workorderDateClose')->setValue(0);
        
        $form->get('invoiceId')->setValue(0);
        
        // if we have ticket set the description and title.
        if($ticketId) {
            $ticketEntity = $this->GetTicket($clientId, $ticketId);
            
            $form->get('workorderTitle')->setValue($ticketEntity->getTicketTitle());
            
            $form->get('workorderDescription')->setValue($ticketEntity->getTicketText());
        }
        
        return $form;
    }
}