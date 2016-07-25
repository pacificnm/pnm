<?php
/**
 * Pacific NM (https://www.pacificnm.com)
 *
 * @link      https://github.com/pacificnm/pnm for the canonical source repository
 * @copyright Copyright (c) 20011-2016 Pacific NM USA Inc. (https://www.pacificnm.com)
 * @license   https://www.pacificnm.com/license/new-bsd New BSD License
 */
namespace CallLog\Controller;

use Zend\View\Model\ViewModel;
use Application\Controller\BaseController;
use Client\Service\ClientServiceInterface;
use CallLog\Service\LogServiceInterface;

class DeleteController extends BaseController
{

    /**
     *
     * @var ClientServiceInterface
     */
    protected $clientService;

    /**
     *
     * @var LogServiceInterface
     */
    protected $logService;

    /**
     *
     * @param ClientServiceInterface $clientService            
     * @param LogServiceInterface $logService            
     */
    public function __construct(ClientServiceInterface $clientService, LogServiceInterface $logService)
    {
        $this->clientService = $clientService;
        
        $this->logService = $logService;
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
        
        $callLogId = $this->params()->fromRoute('callLogId');
        
        $request = $this->getRequest();
        
        // get client
        $clientEntity = $this->clientService->get($id);
        
        // validate we got a client
        if (! $clientEntity) {
            $this->flashmessenger()->addErrorMessage('Client was not found.');
            
            return $this->redirect()->toRoute('client-index');
        }
        
        $logEntity = $this->logService->get($callLogId);
        
        if (! $logEntity) {
            $this->flashMessenger()->addErrorMessage('Call Log was not found');
            
            $this->redirect()->toRoute('call-log-index', array(
                'clientId' => $id
            ));
        }
        
        if ($request->isPost()) {
            $del = $request->getPost('delete_confirmation', 'no');
            
            if ($del === 'yes') {
                
                // set history
                $this->setHistory($this->getRequest()
                    ->getUri(), 'DELETE', $this->identity()
                    ->getAuthId(), 'Deleted Call Log ' . $logEntity->getCallLogId());
                
                $this->logService->delete($logEntity);
                
                $this->flashMessenger()->addSuccessMessage('Call Log was deleted');
                
                return $this->redirect()->toRoute('call-log-index', array(
                    'clientId' => $id
                ));
            }
            
            return $this->redirect()->toRoute('call-log-view', array(
                'clientId' => $id,
                'callLogId' => $callLogId
            ));
        }
        
        // set up layout
        $this->layout()->setVariable('pageTitle', 'Call Log');
        
        $this->layout()->setVariable('pageSubTitle', $clientEntity->getClientName());
        
        $this->layout()->setVariable('activeMenuItem', 'client');
        
        $this->layout()->setVariable('activeSubMenuItem', 'call-log-index');
        
        return new ViewModel(array(
            'logEntity' => $logEntity
        ));
    }
}