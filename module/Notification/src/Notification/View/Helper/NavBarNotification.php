<?php
namespace Notification\View\Helper;
use Zend\View\Helper\AbstractHelper;
use Notification\Service\NotificationServiceInterface;

class NavBarNotification extends AbstractHelper
{
    protected $notificationService;
    
    public function __construct(NotificationServiceInterface $notificationService)
    {
        $this->notificationService = $notificationService;
    }
    
    public function __invoke()
    {
        $view = $this->getView();
    
        $partialHelper = $view->plugin('partial');
        
        $filter = array(
           'employeeId' => $view->Identity()->getEmployeeId(),
            'notificationStatus' => 'Active'
           
        );
        
        $notificationEntitys = $this->notificationService->getAll($filter);
        
        $data  = new \stdClass();
    
        $data->notificationEntitys = $notificationEntitys;

    
        return $partialHelper('partials/nav-bar-notification.phtml', $data);
    }
}