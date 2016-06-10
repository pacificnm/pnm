<?php
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
     * @param ClientServiceInterface $clientService
     * @param WorkorderServiceInterface $workorderService
     * @param WorkorderEmployeeServiceInterface $workorderEmployeeService
     * @param CreditServiceInterface $creditService
     * @param NoteForm $noteForm
     * @param TimeForm $timeForm
     * @param PartForm $partForm
     * @param CompleteForm $completeForm
     * @param CreditForm $creditForm
     */
    public function __construct(ClientServiceInterface $clientService, WorkorderServiceInterface $workorderService, WorkorderEmployeeServiceInterface $workorderEmployeeService, CreditServiceInterface $creditService, NoteForm $noteForm, TimeForm $timeForm, PartForm $partForm, CompleteForm $completeForm, CreditForm $creditForm)
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
            
            return $this->redirect()->toRoute('client-list');
        }
        
        $workorderEntity = $this->workorderService->get($workorderId);
        
        if (! $workorderEntity) {
            $this->flashmessenger()->addErrorMessage('Work Order was not found.');
            
            return $this->redirect()->toRoute('workorder-list', array(
                'clientId' => $id
            ));
        }
        
        // set history
        $this->setHistory($this->getRequest()
            ->getUri(), 'READ', $this->identity()
            ->getAuthId(), 'View Client ' . $clientEntity->getClientName() . ' work order #' . $workorderId);
        
        $this->layout()->setVariable('clientId', $id);
        
        $this->layout()->setVariable('pageTitle', 'View Work Order');
        
        $this->layout()->setVariable('pageSubTitle', $clientEntity->getClientName());
        
        $this->layout()->setVariable('activeMenuItem', 'client');
        
        $this->layout()->setVariable('activeSubMenuItem', 'workorder-list');
        
        $this->setHeadTitle($clientEntity->getClientName());
        
        // note form
        $this->noteForm->get('workorderId')->setValue($workorderId);
        
        $this->noteForm->get('workorderNotesId')->setValue(0);
        
        $this->noteForm->get('workorderNotesDate')->setValue(date("m/d/Y"));
        
        $this->noteForm->setAttribute('Action', $this->url()
            ->fromRoute('workorder-note-create', array(
            'clientId' => $id,
            'workorderId' => $workorderId
        )));
        
        // time form
        $this->timeForm->get('workorderTimeId')->setValue(0);
        
        $this->timeForm->get('workorderId')->setValue($workorderId);
        
        $this->timeForm->get('workorderTimeOut')->setValue(0);
        
        $this->timeForm->get('workorderTimeTotal')->setValue(0);
        
        $this->timeForm->get('laborName')->setValue('not set');
        
        $this->timeForm->get('laborRate')->setValue(0);
        
        $this->timeForm->get('laborTotal')->setValue(0);
        
        $this->timeForm->setAttribute('action', $this->url()
            ->fromRoute('workorder-time-create', array(
            'clientId' => $id,
            'workorderId' => $workorderId
        )));
        
        // part form
        $this->partForm->get('workorderPartsId')->setValue(0);
        
        $this->partForm->get('workorderId')->setValue($workorderId);
        
        $this->partForm->get('workorderPartsTotal')->setValue(0);
        
        $this->partForm->setAttribute('action', $this->url()
            ->fromRoute('workorder-part-create', array(
            'clientId' => $id,
            'workorderId' => $workorderId
        )));
        
        // complete form
        $this->completeForm->get('workorderDateClose')->setValue(date("m/d/Y"));
        
        $this->completeForm->get('createInvoice')->setValue(1);
        
        $this->completeForm->setAttribute('action', $this->url()
            ->fromRoute('workorder-complete', array(
            'clientId' => $id,
            'workorderId' => $workorderId
        )));
        
        // credit form
        $this->creditForm->get('workorderCreditId')->setValue(0);
        
        $this->creditForm->get('workorderId')->setValue($workorderId);
        
        $this->creditForm->get('workorderCreditDate')->setValue(time());
        
        $this->creditForm->get('workorderCreditAmountLeft')->setValue(0);
        
        $this->creditForm->setAttribute('action', $this->url()
            ->fromRoute('workorder-credit-create', array(
            'clientId' => $id,
            'workorderId' => $workorderId
        )));
        
        // employees
        $workorderEmployeEntitys = $this->workorderEmployeeService->getAll(array(
            'workorderId' => $workorderId
        ));
        
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
            'creditForm' => $this->creditForm
        ));
    }
}

?>