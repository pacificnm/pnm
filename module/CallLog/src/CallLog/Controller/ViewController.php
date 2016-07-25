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
use CallLogNote\Service\NoteServiceInterface;

class ViewController extends BaseController
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
     * @var NoteServiceInterface
     */
    protected $noteService;
    
    /**
     * 
     * @param ClientServiceInterface $clientService
     * @param LogServiceInterface $logService
     * @param NoteServiceInterface $noteService
     */
    public function __construct(ClientServiceInterface $clientService, LogServiceInterface $logService, NoteServiceInterface $noteService)
    {
        $this->clientService = $clientService;
        
        $this->logService = $logService;
        
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
        
        $callLogId = $this->params()->fromRoute('callLogId');
        
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
            
            return $this->redirect()->toRoute('call-log-index', array(
                'clientId' => $id
            ));
        }
        
        // set history
        $this->setHistory($this->getRequest()
            ->getUri(), 'READ', $this->identity()
            ->getAuthId(), 'View Call Log for ' . $clientEntity->getClientName());
        
        // mark read
        $logEntity->setCallLogRead(1);
        
        $this->logService->save($logEntity);
        
        $noteEntitys = $this->noteService->getCallLogNotes($callLogId);
        
        // set up layout
        $this->layout()->setVariable('pageTitle', 'View Call Log');
        
        $this->layout()->setVariable('pageSubTitle', $clientEntity->getClientName());
        
        $this->layout()->setVariable('activeMenuItem', 'client');
        
        $this->layout()->setVariable('activeSubMenuItem', 'call-log-index');
        
        // return view model
        return new ViewModel(array(
            'logEntity' => $logEntity,
            'clientId' => $id,
            'clientEntity' => $clientEntity,
            'noteEntitys' => $noteEntitys
        ));
    }
}
