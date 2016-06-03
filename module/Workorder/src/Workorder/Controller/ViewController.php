<?php
namespace Workorder\Controller;

use Application\Controller\BaseController;
use Client\Service\ClientServiceInterface;
use Zend\View\Model\ViewModel;
use Workorder\Service\WorkorderServiceInterface;
use WorkorderEmployee\Service\WorkorderEmployeeServiceInterface;
use WorkorderNote\Service\NoteServiceInterface;
use WorkorderTime\Service\TimeServiceInterface;
use WorkorderPart\Service\PartServiceInterface;
use WorkorderNote\Form\NoteForm;
use WorkorderTime\Form\TimeForm;

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
     * @var NoteServiceInterface
     */
    protected $noteService;

    /**
     *
     * @var TimeServiceInterface
     */
    protected $timeService;

    /**
     *
     * @var PartServiceInterface
     */
    protected $partService;

    /**
     *
     * @var NoteForm
     */
    protected $noteForm;

    protected $timeForm;

    public function __construct(ClientServiceInterface $clientService, WorkorderServiceInterface $workorderService, WorkorderEmployeeServiceInterface $workorderEmployeeService, NoteServiceInterface $noteService, TimeServiceInterface $timeService, PartServiceInterface $partService, NoteForm $noteForm, TimeForm $timeForm)
    {
        $this->clientService = $clientService;
        
        $this->workorderService = $workorderService;
        
        $this->workorderEmployeeService = $workorderEmployeeService;
        
        $this->noteService = $noteService;
        
        $this->timeService = $timeService;
        
        $this->partService = $partService;
        
        $this->noteForm = $noteForm;
        
        $this->timeForm = $timeForm;
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
        
        $this->layout()->setVariable('clientId', $id);
        
        $this->layout()->setVariable('pageTitle', 'View Work Order');
        
        $this->layout()->setVariable('pageSubTitle', $clientEntity->getClientName());
        
        $this->layout()->setVariable('activeMenuItem', 'client');
        
        $this->layout()->setVariable('activeSubMenuItem', 'workorder-list');
        
        $this->setHeadTitle($clientEntity->getClientName());
        
        // note form
        $this->noteForm->get('workorderId')->setValue($workorderId);
        
        $this->noteForm->get('workorderNotesId')->setValue(0);
        
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
        
        $this->timeForm->get('laborName')->setValue(null);
        
        $this->timeForm->get('laborRate')->setValue(null);
        
        $this->timeForm->get('laborTotal')->setValue(null);
        
        $this->timeForm->setAttribute('action', $this->url()
            ->fromRoute('workorder-time-create', array(
            'clientId' => $id,
            'workorderId' => $workorderId
        )));
        
        
        
        // employees
        $workorderEmployeEntitys = $this->workorderEmployeeService->getAll(array(
            'workorderId' => $workorderId
        ));
        
        $noteEntitys = $this->noteService->getAll(array(
            'workorderId' => $workorderId
        ));
        
        $timeEntitys = $this->timeService->getAll(array(
            'workorderId' => $workorderId
        ));
        
        $partEntitys = $this->partService->getAll(array(
            'workorderId' => $workorderId
        ));
        
        // return View
        return new ViewModel(array(
            'clientEntity' => $clientEntity,
            'clientId' => $id,
            'workorderEntity' => $workorderEntity,
            'workorderEmployeEntitys' => $workorderEmployeEntitys,
            'noteEntitys' => $noteEntitys,
            'timeEntitys' => $timeEntitys,
            'partEntitys' => $partEntitys,
            'noteForm' => $this->noteForm,
            'timeForm' => $this->timeForm
        ));
    }
}

?>