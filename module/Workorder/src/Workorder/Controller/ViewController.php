<?php
/**
 * Pacific NM (https://www.pacificnm.com)
 *
 * @link      https://github.com/pacificnm/pnm for the canonical source repository
 * @copyright Copyright (c) 20011-2016 Pacific NM USA Inc. (https://www.pacificnm.com)
 * @license   https://www.pacificnm.com/license/new-bsd New BSD License
 */
namespace Workorder\Controller;

use Application\Controller\BaseController;
use Client\Service\ClientServiceInterface;
use Zend\View\Model\ViewModel;
use Workorder\Service\WorkorderServiceInterface;
use WorkorderEmployee\Service\WorkorderEmployeeServiceInterface;
use WorkorderNote\Form\NoteForm;
use WorkorderTime\Form\TimeForm;
use WorkorderPart\Form\PartForm;
use Workorder\Form\CompleteForm;
use WorkorderCredit\Form\CreditForm;
use WorkorderCredit\Service\CreditServiceInterface;
use WorkorderEmployee\Form\WorkorderEmployeeForm as EmployeeForm;

/**
 * View Work Order Controller
 *
 * @author jaimie (pacificnm@gmail.com)
 *
 */
class ViewController extends BaseController
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
     * @var CreditServiceInterface
     */
    protected $creditService;
    
    /**
     *
     * @var NoteForm
     */
    protected $noteForm;

    /**
     *
     * @var TimeForm
     */
    protected $timeForm;

    /**
     *
     * @var PartForm
     */
    protected $partForm;

    /**
     *
     * @var CompleteForm
     */
    protected $completeForm;

    /**
     *
     * @var CreditForm
     */
    protected $creditForm;

    /**
     * 
     * @var EmployeeForm
     */
    protected $employeeForm;
    
    /**
     * 
     * @param ClientServiceInterface $clientService
     * @param WorkorderServiceInterface $workorderService
     * @param WorkorderEmployeeServiceInterface $workorderEmployeeService
     * @param CreditServiceInterface $creditService
     * @param NoteForm $noteForm
     * @param TimeForm $timeForm
     * @param PartForm $partForm
     * @param CompleteForm $completeForm
     * @param CreditForm $creditForm
     * @param EmployeeForm $employeeForm
     */
    public function __construct(ClientServiceInterface $clientService, WorkorderServiceInterface $workorderService, WorkorderEmployeeServiceInterface $workorderEmployeeService, CreditServiceInterface $creditService, NoteForm $noteForm, TimeForm $timeForm, PartForm $partForm, CompleteForm $completeForm, CreditForm $creditForm, EmployeeForm $employeeForm)
    {
        $this->clientService = $clientService;
        
        $this->workorderService = $workorderService;
        
        $this->workorderEmployeeService = $workorderEmployeeService;
        
        $this->creditService = $creditService;
        
        $this->noteForm = $noteForm;
        
        $this->timeForm = $timeForm;
        
        $this->partForm = $partForm;
        
        $this->completeForm = $completeForm;
        
        $this->creditForm = $creditForm;
        
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
        $id = $this->params()->fromRoute('clientId');
        
        $workorderId = $this->params()->fromRoute('workorderId');
        
        // get client
        $clientEntity = $this->clientService->get($id);
        
        // validate client
        if (! $clientEntity) {
            $this->flashmessenger()->addErrorMessage('Client was not found.');
            
            return $this->redirect()->toRoute('client-index');
        }
        
        // get work order
        $workorderEntity = $this->workorderService->get($workorderId);
        
        // validate work order
        if (! $workorderEntity) {
            $this->flashmessenger()->addErrorMessage('Work Order was not found.');
            
            return $this->redirect()->toRoute('workorder-list', array(
                'clientId' => $id
            ));
        }
        
        // get employees
        $workorderEmployeEntitys = $this->workorderEmployeeService->getAll(array(
            'workorderId' => $workorderId
        ));
        
        // set history
        $this->setHistory($this->getRequest()
            ->getUri(), 'READ', $this->identity()
            ->getAuthId(), 'View Client ' . $clientEntity->getClientName() . ' work order #' . $workorderId);
        
        // note form
        $this->setUpNoteForm($id, $workorderId);
        
        // time form
        $this->setUpTimeForm($id, $workorderId);
        
        // part form
        $this->setUpPartForm($id, $workorderId);
        
        // complete form
        $this->setUpCompleteForm($id, $workorderId);
        
        // credit form
        $this->setUpCreditForm($id, $workorderId);
        
        // employee form
        $this->setUpEmployeeForm($id, $workorderId);
        
        // set layout vars
        $this->layout()->setVariable('clientId', $id);
        
        $this->layout()->setVariable('pageTitle', 'View Work Order');
        
        $this->layout()->setVariable('pageSubTitle', $clientEntity->getClientName());
        
        $this->layout()->setVariable('activeMenuItem', 'client');
        
        $this->layout()->setVariable('activeSubMenuItem', 'workorder-list');
        
        $this->setHeadTitle($clientEntity->getClientName());
        
        // return View
        return new ViewModel(array(
            'clientEntity' => $clientEntity,
            'clientId' => $id,
            'workorderEntity' => $workorderEntity,
            'workorderEmployeEntitys' => $workorderEmployeEntitys,
            'creditTotal' => $this->creditService->getWorkorderTotal($workorderId),
            'noteForm' => $this->noteForm,
            'timeForm' => $this->timeForm,
            'partForm' => $this->partForm,
            'completeForm' => $this->completeForm,
            'creditForm' => $this->creditForm,
            'employeeForm' => $this->employeeForm
        ));
    }

    /**
     * 
     * @param unknown $clientId
     * @param unknown $workorderId
     * @return \Workorder\Controller\ViewController
     */
    protected function setUpCreditForm($clientId, $workorderId)
    {
        $this->creditForm->get('workorderCreditId')->setValue(0);
        
        $this->creditForm->get('workorderId')->setValue($workorderId);
        
        $this->creditForm->get('workorderCreditDate')->setValue(time());
        
        $this->creditForm->get('workorderCreditAmountLeft')->setValue(0);
        
        
        $this->creditForm->get('accountLedgerId')->setValue(0);
        
        $this->creditForm->setAttribute('action', $this->url()
            ->fromRoute('workorder-credit-create', array(
                'clientId' => $clientId,
                'workorderId' => $workorderId
            )));
        
        return $this;
    }
    
    /**
     * 
     * @param unknown $clientId
     * @param unknown $workorderId
     * @return \Workorder\Controller\ViewController
     */
    protected function setUpTimeForm($clientId, $workorderId)
    {
        $this->timeForm->get('workorderTimeId')->setValue(0);
        
        $this->timeForm->get('workorderId')->setValue($workorderId);
        
        $this->timeForm->get('workorderTimeOut')->setValue(0);
        
        $this->timeForm->get('workorderTimeTotal')->setValue(0);
        
        $this->timeForm->get('laborName')->setValue('not set');
        
        $this->timeForm->get('laborRate')->setValue(0);
        
        $this->timeForm->get('laborTotal')->setValue(0);
        
        $this->timeForm->setAttribute('action', $this->url()
            ->fromRoute('workorder-time-create', array(
                'clientId' => $clientId,
                'workorderId' => $workorderId
            )));
        
        return $this;
    }
    
    /**
     * 
     * @param unknown $clientId
     * @param unknown $workorderId
     * @return \Workorder\Controller\ViewController
     */
    protected function setUpPartForm($clientId, $workorderId)
    {
        $this->partForm->get('workorderPartsId')->setValue(0);
        
        $this->partForm->get('workorderId')->setValue($workorderId);
        
        $this->partForm->get('workorderPartsTotal')->setValue(0);
        
        $this->partForm->setAttribute('action', $this->url()
            ->fromRoute('workorder-part-create', array(
                'clientId' => $clientId,
                'workorderId' => $workorderId
            )));
        
        return $this;
    }
    
    /**
     * 
     * @param unknown $clientId
     * @param unknown $workorderId
     * @return \Workorder\Controller\ViewController
     */
    protected function setUpNoteForm($clientId, $workorderId)
    {
        $this->noteForm->get('workorderId')->setValue($workorderId);
        
        $this->noteForm->get('workorderNotesId')->setValue(0);
        
        $this->noteForm->get('workorderNotesDate')->setValue(date("m/d/Y"));
        
        $this->noteForm->setAttribute('Action', $this->url()
            ->fromRoute('workorder-note-create', array(
                'clientId' => $clientId,
                'workorderId' => $workorderId
            )));
       
        return $this;
    }
    
    /**
     * 
     * @param unknown $clientId
     * @param unknown $workorderId
     * @return \Workorder\Controller\ViewController
     */
    protected function setUpCompleteForm($clientId, $workorderId)
    {
        $this->completeForm->get('workorderDateClose')->setValue(date("m/d/Y"));
        
        $this->completeForm->get('createInvoice')->setValue(1);
        
        $this->completeForm->setAttribute('action', $this->url()
            ->fromRoute('workorder-complete', array(
                'clientId' => $clientId,
                'workorderId' => $workorderId
            )));
        
        return $this;
    }
    
    /**
     * 
     * @param unknown $clientId
     * @param unknown $workorderId
     * @return \Workorder\Controller\ViewController
     */
    protected function setUpEmployeeForm($clientId, $workorderId)
    {
        $this->employeeForm->get('workorderId')->setValue($workorderId);
        
        $this->employeeForm->get('workorderEmployeeId')->setValue(0);
        
        $this->employeeForm->setAttribute('action', $this->url()
            ->fromRoute('workorder-employee-create', array(
                'clientId' => $clientId,
                'workorderId' => $workorderId
            )));
        
        return $this;
    }
}