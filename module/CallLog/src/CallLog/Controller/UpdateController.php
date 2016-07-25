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
use CallLog\Form\LogForm;

class UpdateController extends BaseController
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
     * @var LogForm
     */
    protected $logForm;

    /**
     *
     * @param ClientServiceInterface $clientService            
     * @param LogServiceInterface $logService            
     */
    public function __construct(ClientServiceInterface $clientService, LogServiceInterface $logService, LogForm $logForm)
    {
        $this->clientService = $clientService;
        
        $this->logService = $logService;
        
        $this->logForm = $logForm;
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
            
            return $this->redirect()->toRoute('call-log-index', array(
                'clientId' => $id
            ));
        }
        
        // if we have a post
        if ($request->isPost()) {
        
            $postData = $request->getPost();
        
            $this->logForm->setData($postData);
        
            // if the form is valid
            if ($this->logForm->isValid()) {
        
                $entity = $this->logForm->getData();
        
                $entity->setCallLogTime(strtotime($entity->getCallLogTime()));
                
                $logEntity = $this->logService->save($entity);
        
                // set history
                $this->setHistory($this->getRequest()
                    ->getUri(), 'UPDATE', $this->identity()
                    ->getAuthId(), 'Updated Call Log ' . $logEntity->getCallLogId());
        
                // set message
                $this->flashMessenger()->addSuccessMessage('The call log was saved');
        
                // return to the view page
                return $this->redirect()->toRoute('call-log-view', array(
                    'clientId' => $id,
                    'callLogId' => $logEntity->getCallLogId()
                ));
            }
        }
        
        $this->logForm->bind($logEntity);
        
        // set time
        $this->logForm->get('callLogTime')->setValue(date("m/d/Y h:i a", $logEntity->getCallLogTime()));
        
        // set up layout
        $this->layout()->setVariable('pageTitle', 'Call Log');
        
        $this->layout()->setVariable('pageSubTitle', $clientEntity->getClientName());
        
        $this->layout()->setVariable('activeMenuItem', 'client');
        
        $this->layout()->setVariable('activeSubMenuItem', 'call-log-index');
        
        return new ViewModel(array(
            'clientId' => $id,
            'form' => $this->logForm
        ));
    }
}

?>