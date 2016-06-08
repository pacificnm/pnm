<?php
namespace Workorder\Controller;

use Application\Controller\BaseController;
use Client\Service\ClientServiceInterface;
use Zend\View\Model\ViewModel;
use Workorder\Service\WorkorderServiceInterface;
use WorkorderNote\Service\NoteServiceInterface;
use WorkorderTime\Service\TimeServiceInterface;
use WorkorderPart\Service\PartServiceInterface;

class PrintController extends BaseController
{
    /**
     *
     * @var ClientServiceInterface
     */
    protected $clientService;
    
    protected $workorderService;
    
    protected $noteService;
    
    protected $timeService;
    
    protected $partService;
    
    
    public function __construct(ClientServiceInterface $clientService, WorkorderServiceInterface $workorderService, NoteServiceInterface $noteService, TimeServiceInterface $timeService, PartServiceInterface $partService)
    {
        $this->clientService = $clientService;
        
        $this->workorderService = $workorderService;
        
        $this->noteService = $noteService;
        
        $this->timeService = $timeService;
        
        $this->partService = $partService;
    }
    
    /**
     *
     * {@inheritDoc}
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
            ->getAuthId(), 'View Client ' . $clientEntity->getClientName() . ' print work order #' . $workorderId);
        
        $noteEntitys = $this->noteService->getAll(array(
            'workorderId' => $workorderId
        ));
        
        $timeEntitys = $this->timeService->getAll(array(
            'workorderId' => $workorderId
        ));
        
        $partEntitys = $this->partService->getAll(array(
            'workorderId' => $workorderId
        ));
        
        $this->layout('/layout/print.phtml');
    
        // return View
        return new ViewModel(array(
            'clientEntity' => $clientEntity,
            'clientId' => $id,
            'workorderEntity' => $workorderEntity,
            'noteEntitys' => $noteEntitys,
            'timeEntitys' => $timeEntitys,
            'partEntitys' => $partEntitys
        ));
    }
}

?>