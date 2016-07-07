<?php
namespace WorkorderEmployee\Controller;

use Application\Controller\BaseController;
use Client\Service\ClientServiceInterface;
use Workorder\Service\WorkorderServiceInterface;
use WorkorderEmployee\Service\WorkorderEmployeeServiceInterface;
use WorkorderEmployee\Form\WorkorderEmployeeForm;

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
    protected $employeeService;

    /**
     *
     * @var WorkorderEmployeeForm
     */
    protected $employeeForm;

    /**
     *
     * @param ClientServiceInterface $clientService            
     * @param WorkorderServiceInterface $workorderService            
     * @param WorkorderEmployeeServiceInterface $employeeService            
     * @param WorkorderEmployeeForm $employeeForm            
     */
    public function __construct(ClientServiceInterface $clientService, WorkorderServiceInterface $workorderService, WorkorderEmployeeServiceInterface $employeeService, WorkorderEmployeeForm $employeeForm)
    {
        $this->clientService = $clientService;
        
        $this->workorderService = $workorderService;
        
        $this->employeeService = $employeeService;
        
        $this->employeeForm = $employeeForm;
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \Zend\Mvc\Controller\AbstractActionController::indexAction()
     */
    public function indexAction()
    {
        $request = $this->getRequest();
        
        $clientId = $this->params()->fromRoute('clientId');
        
        $workorderId = $this->params()->fromRoute('workorderId');
        
        // get client
        $clientEntity = $this->clientService->get($clientId);
        
        // validate we got a client
        if (! $clientEntity) {
            $this->flashMessenger()->addErrorMessage('Can not find client');
            
            return $this->redirect()->toRoute('client-index');
        }
        
        $workorderEntity = $this->workorderService->get($workorderId);
        
        // validate work order
        if (! $workorderEntity) {
            $this->flashMessenger()->addErrorMessage('can not find work order');
            
            return $this->redirect()->toRoute('workorder-list', array(
                'clientId' => $clientId
            ));
        }
        
        // if we have a post
        if ($request->isPost()) {
            
            $postData = $request->getPost();
            
            $this->employeeForm->setData($postData);
            
            // if form is valid
            if ($this->employeeForm->isValid()) {
                
                $entity = $this->employeeForm->getData();
                
                $entity = $this->employeeService->save($entity);
                
                // load the enity back to get employee name for history
                $employeeEntity = $this->employeeService->getEmployeeWorkorder($entity->getEmployeeId(), $workorderId);
                
                // @todo send email to employee to let them no they have been added
                
                // set history
                $this->setHistory($this->getRequest()
                    ->getUri(), 'CREATE', $this->identity()
                    ->getAuthId(), "Added employee {$employeeEntity->getEmployeeEntity()->getEmployeeName()} to work order #{$workorderId}");
                
                $this->flashMessenger()->addSuccessMessage('The employee was added to the work order');
                
                return $this->redirect()->toRoute('workorder-view', array(
                    'clientId' => $clientId,
                    'workorderId' => $workorderId
                ));
            }
            
            // hack
            $messages = $this->employeeForm->getMessages();
            foreach($messages as $key => $message) {
                $errorMsg = key($message);
            }
            
           
            
            // validation error
            $this->flashMessenger()->addErrorMessage('Falied to add employee to work order: ' . $errorMsg);
            
            // return to view the work order
            return $this->redirect()->toRoute('workorder-view', array(
                'clientId' => $clientId,
                'workorderId' => $workorderId
            ));
        }
        
        // no post
        $this->flashMessenger()->addErrorMessage('Falied to add employee to work order');
        
        // return
        return $this->redirect()->toRoute('workorder-view', array(
            'clientId' => $clientId,
            'workorderId' => $workorderId
        ));
    }
}
