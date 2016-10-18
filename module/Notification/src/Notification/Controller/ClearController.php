<?php
namespace Notification\Controller;

use Application\Controller\BaseController;
use Notification\Service\NotificationServiceInterface;

class ClearController extends BaseController
{

    /**
     * 
     * @var NotificationServiceInterface
     */
    protected $notificationService;

    /**
     * 
     * @param NotificationServiceInterface $notificationService
     */
    public function __construct(NotificationServiceInterface $notificationService)
    {
        $this->notificationService = $notificationService;
    }

    /**
     * 
     * {@inheritDoc}
     * @see \Zend\Mvc\Controller\AbstractActionController::indexAction()
     */
    public function indexAction()
    {        
        $this->notificationService->clearNotifications($this->identity()->getEmployeeId());
        
        $this->flashMessenger()->addSuccessMessage('Notifications where cleared');
        
        return $this->redirect()->toRoute('employee-profile');
    }
}
