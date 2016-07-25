<?php
/**
 * Pacific NM (https://www.pacificnm.com)
 *
 * @link      https://github.com/pacificnm/pnm for the canonical source repository
 * @copyright Copyright (c) 20011-2016 Pacific NM USA Inc. (https://www.pacificnm.com)
 * @license   https://www.pacificnm.com/license/new-bsd New BSD License
 */
namespace Notification\Service\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use Notification\Service\NotificationService;
class NotificationServiceFactory
{
    /**
     * 
     * @param ServiceLocatorInterface $serviceLocator
     * @return \Notification\Service\NotificationService
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
     
        $mapper = $serviceLocator->get('Notification\Mapper\NotificationMapperInterface');
        
        return new NotificationService($mapper);
    }
}