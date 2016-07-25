<?php
/**
 * Pacific NM (https://www.pacificnm.com)
 *
 * @link      https://github.com/pacificnm/pnm for the canonical source repository
 * @copyright Copyright (c) 20011-2016 Pacific NM USA Inc. (https://www.pacificnm.com)
 * @license   https://www.pacificnm.com/license/new-bsd New BSD License
 */
namespace Notification\Mapper\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Stdlib\Hydrator\Aggregate\AggregateHydrator;
use Notification\Mapper\NotificationMapper;
use Notification\Hydrator\NotificationHydrator;
use Notification\Entity\NotificationEntity;

class NotificationMapperFactory
{

    /**
     * 
     * @param ServiceLocatorInterface $serviceLocator
     * @return \Notification\Mapper\NotificationMapper
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        $hydrator = new AggregateHydrator();
        
        $hydrator->add(new NotificationHydrator());
        
        $prototype = new NotificationEntity();
        
        $readAdapter = $serviceLocator->get('db1');
        
        $writeAdapter = $serviceLocator->get('db2');
        
        return new NotificationMapper($readAdapter, $writeAdapter, $hydrator, $prototype);
    }
}