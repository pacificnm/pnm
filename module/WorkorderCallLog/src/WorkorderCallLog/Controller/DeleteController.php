<?php
namespace WorkorderCallLog\Controller;

use Client\Controller\ClientBaseController;
use WorkorderCallLog\Service\WorkorderCallLogServiceInterface;
use Zend\View\Model\ViewModel;

class DeleteController extends ClientBaseController
{

    /**
     *
     * @var WorkorderCallLogServiceInterface
     */
    protected $workorderCallLogService;

    /**
     *
     * @param WorkorderCallLogServiceInterface $workorderCallLogService            
     */
    public function __construct(WorkorderCallLogServiceInterface $workorderCallLogService)
    {
        $this->workorderCallLogService = $workorderCallLogService;
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \Client\Controller\ClientBaseController::indexAction()
     */
    public function indexAction()
    {
        $workorderCallLogId = $this->params('workorderCallLogId');
        
        $request = $this->getRequest();
        
        $workorderCallLogEntity = $this->workorderCallLogService->get($workorderCallLogId);
        
        // validate we got a call log
        if (! $workorderCallLogEntity) {
            $this->flashMessenger()->addErrorMessage('Call Log not found');
            
            return $this->redirect()->toRoute('call-log-index', array(
                'clientId' => $this->clientId
            ));
        }
        
        // if we have a post
        if ($request->isPost()) {
            $del = $request->getPost('delete_confirmation', 'no');
            
            if ($del === 'yes') {
                
                // delete
                $this->workorderCallLogService->delete($workorderCallLogEntity);
                
                // set flash messenger
                $this->flashmessenger()->addSuccessMessage('The work order was removed');
                
                // trigger event
                $this->getEventManager()->trigger('workorderCallLogDelete', $this, array(
                    'authId' => $this->identity()
                        ->getAuthId(),
                    'historyUrl' => $this->getRequest()
                        ->getUri(),
                    'logId' => $workorderCallLogEntity->getCallLogId(),
                    'workorderId' => $workorderCallLogEntity->getWorkorderId()
                ));
            }
            
            return $this->redirect()->toRoute('call-log-view', array(
                'clientId' => $this->clientId,
                'callLogId' => $workorderCallLogEntity->getCallLogId()
            ));
        }
        
        // return view model
        return new ViewModel(array(
            'workorderCallLogEntity' => $workorderCallLogEntity,
            'workorderEntity' => $workorderCallLogEntity->getWorkorderEntity()
        ));
    }
}
