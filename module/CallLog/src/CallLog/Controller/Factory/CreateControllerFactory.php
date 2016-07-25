<?php
/**
 * Pacific NM (https://www.pacificnm.com)
 *
 * @link      https://github.com/pacificnm/pnm for the canonical source repository
 * @copyright Copyright (c) 20011-2016 Pacific NM USA Inc. (https://www.pacificnm.com)
 * @license   https://www.pacificnm.com/license/new-bsd New BSD License
 */
namespace CallLog\Controller\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use CallLog\Controller\CreateController;
class CreateControllerFactory
{
    /**
     * 
     * @param ServiceLocatorInterface $serviceLocator
     * @return \CallLog\Controller\CreateController
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        $realServiceLocator = $serviceLocator->getServiceLocator();
        
        $clientService = $realServiceLocator->get('Client\Service\ClientServiceInterface');
        
        $logService = $realServiceLocator->get('CallLog\Service\LogServiceInterface');
        
        $notificationService = $realServiceLocator->get('Notification\Service\NotificationServiceInterface');
        
        $logForm = $realServiceLocator->get('CallLog\Form\LogForm');
        
        return new CreateController($clientService, $logService, $notificationService, $logForm);
    }
}