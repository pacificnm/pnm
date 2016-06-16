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
        
        if (! $clientEntity) {
            $this->flashmessenger()->addErrorMessage('Client was not found.');
            
            return $this->redirect()->toRoute('client-list');
        }
        
        $this->layout()->setVariable('clientId', $id);
        
        $this->layout()->setVariable('pageTitle', 'Create Work Order');
        
        $this->layout()->setVariable('pageSubTitle', $clientEntity->getClientName());
        
        $this->layout()->setVariable('activeMenuItem', 'client');
        
        $this->layout()->setVariable('activeSubMenuItem', 'workorder-list');
        
        $this->setHeadTitle($clientEntity->getClientName());
        
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
                
                // send messages
                $employeeEntity = $this->employeeService->get($workorderEmployeeEntity->getEmployeeId());
                
                $this->messageService->saveEmployeeWorkorder($workorderEntity, $employeeEntity);
                
                $this->messageService->saveUserWorkorder($workorderEntity, $userEntity);
                
                // create history
                
                $this->flashmessenger()->addSuccessMessage('The work order was saved.');
                
                return $this->redirect()->toRoute('workorder-view', array(
                    'clientId' => $id,
                    'workorderId' => $workorderEntity->getWorkorderId()
                ));
            }
        }
        
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
        
        // return View
        return new ViewModel(array(
            'clientEntity' => $clientEntity,
            'clientId' => $id,
            'form' => $form,
            'workorderEmployeeForm' => $workorderEmployeeForm
        ));
    }
}