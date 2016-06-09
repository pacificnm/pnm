<?php
namespace WorkorderNote\Controller;

use Application\Controller\BaseController;
use Client\Service\ClientServiceInterface;
use Workorder\Service\WorkorderServiceInterface;
use WorkorderNote\Service\NoteServiceInterface;
use Zend\View\Model\ViewModel;

class DeleteController extends BaseController
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
     * @param ClientServiceInterface $clientService            
     * @param WorkorderServiceInterface $workorderService            
     * @param NoteServiceInterface $noteService            
     */
    public function __construct(ClientServiceInterface $clientService, WorkorderServiceInterface $workorderService, NoteServiceInterface $noteService)
    {
        $this->clientService = $clientService;
        
        $this->workorderService = $workorderService;
        
        $this->noteService = $noteService;
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
            
            return $this->redirect()->toRoute('client-list');
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
        
        $this->layout()->setVariable('pageTitle', 'Delete Work Order Note');
        
        $this->layout()->setVariable('pageSubTitle', $clientEntity->getClientName());
        
        $this->layout()->setVariable('activeMenuItem', 'client');
        
        $this->layout()->setVariable('activeSubMenuItem', 'workorder-list');
        
        $this->setHeadTitle($clientEntity->getClientName());
        
        $request = $this->getRequest();
        
        if ($request->isPost()) {
            $del = $request->getPost('delete_confirmation', 'no');
            
            if ($del === 'yes') {
                
                $this->noteService->delete($noteEntity);
                
                $this->flashmessenger()->addSuccessMessage('The work order note was deleted');
            }
            
            return $this->redirect()->toRoute('workorder-view', array(
                'clientId' => $id,
                'workorderId' => $workorderId
            ));
        }
        
        // return View
        return new ViewModel(array(
            'clientEntity' => $clientEntity,
            'clientId' => $id,
            'noteEntity' => $noteEntity
        ));
    }
}
