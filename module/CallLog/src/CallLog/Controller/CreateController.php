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
use Notification\Service\NotificationServiceInterface;
use Notification\Entity\NotificationEntity;

class CreateController extends BaseController
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
     * @var NotificationServiceInterface
     */
    protected $notificationService;
    
    /**
     *
     * @var LogForm
     */
    protected $logForm;

    /**
     * 
     * @param ClientServiceInterface $clientService
     * @param LogServiceInterface $logService
     * @param NotificationServiceInterface $notificationService
     * @param LogForm $logForm
     */
    public function __construct(ClientServiceInterface $clientService, LogServiceInterface $logService, NotificationServiceInterface $notificationService, LogForm $logForm)
    {
        $this->clientService = $clientService;
        
        $this->logService = $logService;
        
        $this->notificationService = $notificationService;
        
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
        
        $request = $this->getRequest();
        
        // get client
        $clientEntity = $this->clientService->get($id);
        
        // validate we got a client
        if (! $clientEntity) {
            $this->flashmessenger()->addErrorMessage('Client was not found.');
            
            return $this->redirect()->toRoute('client-index');
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
                    ->getUri(), 'CREATE', $this->identity()
                    ->getAuthId(), 'Created Call Log ' . $logEntity->getCallLogId());
                
                // if this call log is for some one else create notification
                if($logEntity->getEmployeeId() != $this->identity()->getEmployeeId()) {
                    $notificationEntity = new NotificationEntity();
                    
                    $url = $this->url()->fromRoute('call-log-view', array('clientId' => $id, 'callLogId' => $logEntity->getCallLogId()));
                    
                    $notificationText = 'New call log from client ' . $clientEntity->getClientName() . '. <a href="'.$url.'" title="View this call log">View Call Log</a>';
                    
                    $notificationEntity->setEmployeeId($logEntity->getEmployeeId());
                    $notificationEntity->setNotificationDate(time());
                    $notificationEntity->setNotificationId(0);
                    $notificationEntity->setNotificationStatus('Active');
                    $notificationEntity->setNotificationText($notificationText);
                    
                    
                    
                    
                    $this->notificationService->save($notificationEntity);
                }
                
                // set message
                $this->flashMessenger()->addSuccessMessage('The call log was saved');
                
                // return to the view page
                return $this->redirect()->toRoute('call-log-view', array(
                    'clientId' => $id,
                    'callLogId' => $logEntity->getCallLogId()
                ));
            }
        }
        
        // set up form
        $this->logForm->get('callLogId')->setValue(0);
        
        $this->logForm->get('clientId')->setValue($id);
        
        $this->logForm->get('callLogCreatedBy')->setValue($this->identity()->getAuthId());
        
        $this->logForm->get('callLogTime')->setValue(date("m/d/Y h:i a"));
        
        $this->logForm->get('callLogRead')->setValue(0);
        
        // set up layout
        $this->layout()->setVariable('pageTitle', 'Call Log');
        
        $this->layout()->setVariable('pageSubTitle', $clientEntity->getClientName());
        
        $this->layout()->setVariable('activeMenuItem', 'client');
        
        $this->layout()->setVariable('activeSubMenuItem', 'call-log-index');
        
        // return view model
        return new ViewModel(array(
            'form' => $this->logForm
        ));
    }
}

?>