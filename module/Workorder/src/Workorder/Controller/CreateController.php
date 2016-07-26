<?php
namespace Workorder\Controller;

use Application\Controller\BaseController;
use Client\Service\ClientServiceInterface;
use Zend\View\Model\ViewModel;
use Workorder\Service\WorkorderServiceInterface;
use Workorder\Form\WorkorderForm;
use WorkorderEmployee\Service\WorkorderEmployeeServiceInterface;
use WorkorderEmployee\Form\WorkorderEmployeeForm;
use Location\Service\LocationServiceInterface;
use Phone\Service\PhoneServiceInterface;
use User\Service\UserServiceInterface;
use Message\Service\MessageServiceInterface;
use Employee\Service\EmployeeServiceInterface;
use WorkorderCredit\Service\CreditServiceInterface;
use WorkorderCredit\Entity\CreditEntity;

class CreateController extends BaseController
{

    /**
     *
     * @var ClientServiceInterface
     */
    protected $clientService;

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
     * @var LocationServiceInterface
     */
    protected $locationService;

    /**
     *
     * @var PhoneServiceInterface
     */
    protected $phoneService;

    /**
     *
     * @var UserServiceInterface
     */
    protected $userService;

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
     * @param ClientServiceInterface $clientService
     * @param WorkorderServiceInterface $workorderService
     * @param WorkorderEmployeeServiceInterface $workorderEmployeeService
     * @param LocationServiceInterface $locationService
     * @param PhoneServiceInterface $phoneService
     * @param UserServiceInterface $userService
     * @param MessageServiceInterface $messageService
     * @param EmployeeServiceInterface $employeeService
     * @param CreditServiceInterface $creditService
     * @param WorkorderForm $workorderForm
     * @param WorkorderEmployeeForm $workorderEmployeeForm
     */
    public function __construct(ClientServiceInterface $clientService, WorkorderServiceInterface $workorderService, WorkorderEmployeeServiceInterface $workorderEmployeeService, LocationServiceInterface $locationService, PhoneServiceInterface $phoneService, UserServiceInterface $userService, MessageServiceInterface $messageService, EmployeeServiceInterface $employeeService, CreditServiceInterface $creditService, WorkorderForm $workorderForm, WorkorderEmployeeForm $workorderEmployeeForm)
    {
        $this->clientService = $clientService;
        
        $this->workorderService = $workorderService;
        
        $this->workorderEmployeeService = $workorderEmployeeService;
        
        $this->locationService = $locationService;
        
        $this->phoneService = $phoneService;
        
        $this->userService = $userService;
        
        $this->messageService = $messageService;
        
        $this->employeeService = $employeeService;
        
        $this->creditService = $creditService;
        
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
        $id = $this->params()->fromRoute('clientId');
        
        $clientEntity = $this->clientService->get($id);
        
        // validate we have a client
        if (! $clientEntity) {
            $this->flashmessenger()->addErrorMessage('Client was not found.');
            
            return $this->redirect()->toRoute('client-index');
        }
        
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
                
                $workorderEmployeeEntity = $workorderEmployeeForm->getData();
                
                $locationEntity = $this->locationService->get($postData['locationId']);
                
                if ($locationEntity) {
                    $phoneEntity = $this->phoneService->getPrimaryPhoneByLocation($postData['locationId']);
                
                    if ($phoneEntity) {
                        $workorderEntity->setPhoneId($phoneEntity->getPhoneId());
                    }
                
                    $userEntity = $this->userService->getPrimaryUserByLocation($postData['locationId']);
                
                    if ($userEntity) {
                        $workorderEntity->setUserId($userEntity->getUserId());
                    }
                }
                
                $datePieces = explode('-', $postData['workorderDateScheduled']);
                
                $workorderEntity->setWorkorderDateScheduled(strtotime($datePieces[0]));
                
                $workorderEntity->setWorkorderDateEnd(strtotime($datePieces[1]));
                
                // save work order
                $workorderEntity = $this->workorderService->save($workorderEntity);
                
                // map to employee
                $workorderEmployeeEntity->setWorkorderId($workorderEntity->getWorkorderId());
                
                $workorderEmployeeEntity = $this->workorderEmployeeService->save($workorderEmployeeEntity);
                
                // check if there is a credit balance if so map the balance
                $creditEntityBalance = $this->creditService->getWorkorderCreditBalance($id);
                
                if($creditEntityBalance) {
                    if($creditEntityBalance->getWorkorderCreditAmountLeft() > 0) {
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
                        $creditEntity->setWorkorderId($workorderEntity->getWorkorderId());
                        
                        
                        $this->creditService->save($creditEntity);
                    }
                }
                
                
                // send messages
                $employeeEntity = $this->employeeService->get($workorderEmployeeEntity->getEmployeeId());
                
                $this->messageService->saveEmployeeWorkorder($workorderEntity, $employeeEntity);
                
                $this->messageService->saveUserWorkorder($workorderEntity, $userEntity);
                
                // save history
                $this->SetWorkorderHistory($this->getRequest()
                    ->getUri(), 'CREATE', $this->identity()
                    ->getAuthId(), 'Created work order #' . $workorderEntity->getWorkorderId(), $workorderEntity->getWorkorderId());
                
                $this->flashmessenger()->addSuccessMessage('The work order was saved.');
                
                return $this->redirect()->toRoute('workorder-view', array(
                    'clientId' => $id,
                    'workorderId' => $workorderEntity->getWorkorderId()
                ));
            } 
        }
        
        // setup form
        $form->setClientId($id);
        
        $form->getLocation();
        
        $form->get('workorderId')->setValue(0);
        
        $form->get('userId')->setValue(0);
        
        $form->get('phoneId')->setValue(0);
        
        $form->get('workorderParts')->setValue(0);
        
        $form->get('workorderLabor')->setValue(0);
        
        $form->get('clientId')->setValue($id);
        
        $form->get('workorderDateCreate')->setValue(time());
        
        $form->get('workorderDateEnd')->setValue(0);
        
        $form->get('workorderDateClose')->setValue(0);
        
        $form->get('invoiceId')->setValue(0);
        
        $workorderEmployeeForm->get('workorderEmployeeId')->setValue(0);
        
        // set up layout
        $this->layout()->setVariable('clientId', $id);
        
        $this->layout()->setVariable('pageTitle', 'Create Work Order');
        
        $this->layout()->setVariable('pageSubTitle', $clientEntity->getClientName());
        
        $this->layout()->setVariable('activeMenuItem', 'client');
        
        $this->layout()->setVariable('activeSubMenuItem', 'workorder-list');
        
        $this->setHeadTitle($clientEntity->getClientName());
        
        // return View
        return new ViewModel(array(
            'clientEntity' => $clientEntity,
            'clientId' => $id,
            'form' => $form,
            'workorderEmployeeForm' => $workorderEmployeeForm
        ));
    }
}