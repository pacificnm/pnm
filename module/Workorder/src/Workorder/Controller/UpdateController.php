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

class UpdateController extends BaseController
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
     * @param WorkorderForm $workorderForm            
     * @param WorkorderEmployeeForm $workorderEmployeeForm            
     */
    public function __construct(ClientServiceInterface $clientService, WorkorderServiceInterface $workorderService, WorkorderEmployeeServiceInterface $workorderEmployeeService, LocationServiceInterface $locationService, PhoneServiceInterface $phoneService, UserServiceInterface $userService, MessageServiceInterface $messageService, EmployeeServiceInterface $employeeService, WorkorderForm $workorderForm, WorkorderEmployeeForm $workorderEmployeeForm)
    {
        $this->clientService = $clientService;
        
        $this->workorderService = $workorderService;
        
        $this->workorderEmployeeService = $workorderEmployeeService;
        
        $this->locationService = $locationService;
        
        $this->phoneService = $phoneService;
        
        $this->userService = $userService;
        
        $this->messageService = $messageService;
        
        $this->employeeService = $employeeService;
        
        $this->workorderForm = $workorderForm;
        
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
        
        $workorderId = $this->params()->fromRoute('workorderId');
        
        $clientEntity = $this->clientService->get($id);
        
        if (! $clientEntity) {
            $this->flashmessenger()->addErrorMessage('Client was not found.');
            
            return $this->redirect()->toRoute('client-index');
        }
        
        $workorderEntity = $this->workorderService->get($workorderId);
        
        if (! $workorderEntity) {
            $this->flashmessenger()->addErrorMessage('Work Order was not found.');
            
            return $this->redirect()->toRoute('workorder-list', array(
                'clientId' => $id
            ));
        }
        
        $this->layout()->setVariable('clientId', $id);
        
        $this->layout()->setVariable('pageTitle', 'Edit Work Order');
        
        $this->layout()->setVariable('pageSubTitle', $clientEntity->getClientName());
        
        $this->layout()->setVariable('activeMenuItem', 'client');
        
        $this->layout()->setVariable('activeSubMenuItem', 'workorder-list');
        
        $this->setHeadTitle($clientEntity->getClientName());
        
        $form = $this->workorderForm;
        
        $form->setClientId($id);
        
        $form->getLocation();
        
        $workorderEmployeeForm = $this->workorderEmployeeForm;
        
        $request = $this->getRequest();
        
        // if we have a post
        if ($request->isPost()) {
            
            // get post
            $postData = $request->getPost();
            
            $form->setData($postData);
                        
            // if we are valid
            if ($form->isValid()) {
                
                $workorderEntity = $form->getData();
                
                $workorderEntity->setLocationId($postData['locationId']);
                
                                
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

                // set history
                $this->SetWorkorderHistory($this->getRequest()
                    ->getUri(), 'UPDATE', $this->identity()
                    ->getAuthId(), 'Edit work order #' . $workorderEntity->getWorkorderId(), $workorderEntity->getWorkorderId());
                
                $this->flashmessenger()->addSuccessMessage('The work order was saved.');
                
                return $this->redirect()->toRoute('workorder-view', array(
                    'clientId' => $id,
                    'workorderId' => $workorderEntity->getWorkorderId()
                ));
            }
        }
        
        $form->bind($workorderEntity);
        
        $value = date("m/d/Y h:i A", $workorderEntity->getWorkorderDateScheduled()) . ' - ' . date("m/d/Y h:i A", $workorderEntity->getWorkorderDateEnd());
        
        $form->get('workorderDateScheduled')->setValue($value);
        
        // return View
        return new ViewModel(array(
            'clientEntity' => $clientEntity,
            'clientId' => $id,
            'form' => $form,
        ));
    }
}