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
use Client\Service\ClientServiceInterface;
use CallLog\Service\LogServiceInterface;
use CallLog\Form\LogForm;
use Notification\Service\NotificationServiceInterface;
use Client\Controller\ClientBaseController;

class CreateController extends ClientBaseController
{

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
     * @param NotificationServiceInterface $notificationService            
     * @param LogForm $logForm            
     */
    public function __construct(LogServiceInterface $logService, LogForm $logForm)
    {
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
        parent::indexAction();
        
        $request = $this->getRequest();
        
        // if we have a post
        if ($request->isPost()) {
            
            $postData = $request->getPost();
            
            $this->logForm->setData($postData);
            
            // if the form is valid
            if ($this->logForm->isValid()) {
                
                $entity = $this->logForm->getData();
                
                $entity->setCallLogTime(strtotime($entity->getCallLogTime()));
                
                $logEntity = $this->logService->save($entity);
     
                // trigger callLogCreate event
                $this->getEventManager()->trigger('callLogCreate', $this, array(
                    'logEntity' => $logEntity,
                    'authId' => $this->identity()
                        ->getAuthId(),
                    'historyUrl' => $this->getRequest()
                        ->getUri()
                ));
                
                // set message
                $this->flashMessenger()->addSuccessMessage('The call log was saved');
                
                // return to the view page
                return $this->redirect()->toRoute('call-log-view', array(
                    'clientId' => $this->clientId,
                    'callLogId' => $logEntity->getCallLogId()
                ));
            }
        }
        
        // set up form
        $this->logForm->get('callLogId')->setValue(0);
        
        $this->logForm->get('clientId')->setValue($this->clientId);
        
        $this->logForm->get('callLogCreatedBy')->setValue($this->identity()
            ->getAuthId());
        
        $this->logForm->get('callLogTime')->setValue(date("m/d/Y h:i a"));
        
        $this->logForm->get('callLogRead')->setValue(0);
        
        // return view model
        return new ViewModel(array(
            'form' => $this->logForm
        ));
    }
}