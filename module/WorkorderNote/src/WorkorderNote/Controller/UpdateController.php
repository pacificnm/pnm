<?php
namespace WorkorderNote\Controller;

use Application\Controller\BaseController;
use Client\Service\ClientServiceInterface;
use Workorder\Service\WorkorderServiceInterface;
use WorkorderNote\Service\NoteServiceInterface;
use WorkorderNote\Form\NoteForm;
use Zend\View\Model\ViewModel;

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
     * @var NoteServiceInterface
     */
    protected $noteService;

    /**
     *
     * @var NoteForm
     */
    protected $noteForm;

    /**
     *
     * @param ClientServiceInterface $clientService            
     * @param WorkorderServiceInterface $workorderService            
     * @param NoteServiceInterface $noteService            
     * @param NoteForm $noteForm            
     */
    public function __construct(ClientServiceInterface $clientService, WorkorderServiceInterface $workorderService, NoteServiceInterface $noteService, NoteForm $noteForm)
    {
        $this->clientService = $clientService;
        
        $this->workorderService = $workorderService;
        
        $this->noteService = $noteService;
        
        $this->noteForm = $noteForm;
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
        
        $workorderNotesId = $this->params()->fromRoute('workorderNotesId');
        
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
        
        $noteEntity = $this->noteService->get($workorderNotesId);
        
        if (! $noteEntity) {
            $this->flashmessenger()->addErrorMessage('Work Order note was not found.');
            
            return $this->redirect()->toRoute('workorder-view', array(
                'clientId' => $id,
                'workorderId' => $workorderId
            ));
        }
        
        $this->layout()->setVariable('clientId', $id);
        
        $this->layout()->setVariable('pageTitle', 'Edit Work Order Note');
        
        $this->layout()->setVariable('pageSubTitle', $clientEntity->getClientName());
        
        $this->layout()->setVariable('activeMenuItem', 'client');
        
        $this->layout()->setVariable('activeSubMenuItem', 'workorder-list');
        
        $this->setHeadTitle($clientEntity->getClientName());
        
        $request = $this->getRequest();
        
        // if we have a post
        if ($request->isPost()) {
            $postData = $request->getPost();
            
            $this->noteForm->setData($postData);
            
            if ($this->noteForm->isValid()) {
                
                $entity = $this->noteForm->getData();
                
                $entity->setWorkorderNotesDate(strtotime($postData['workorderNotesDate']));
                
                $noteEntity = $this->noteService->save($entity);
                
                $this->flashmessenger()->addSuccessMessage('The work order note was saved.');
                
                return $this->redirect()->toRoute('workorder-view', array(
                    'clientId' => $id,
                    'workorderId' => $workorderId
                ));
            }
        } else {
            
            $noteEntity->setWorkorderNotesDate(date("m/d/Y", $noteEntity->getWorkorderNotesDate()));
            
            $this->noteForm->bind($noteEntity);
        }
        
        // return View
        return new ViewModel(array(
            'clientEntity' => $clientEntity,
            'clientId' => $id,
            'workorderEntity' => $workorderEntity,
            'noteForm' => $this->noteForm
        ));
    }
}