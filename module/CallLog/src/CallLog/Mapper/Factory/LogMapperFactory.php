<?php
/**
 * Pacific NM (https://www.pacificnm.com)
 *
 * @link      https://github.com/pacificnm/pnm for the canonical source repository
 * @copyright Copyright (c) 20011-2016 Pacific NM USA Inc. (https://www.pacificnm.com)
 * @license   https://www.pacificnm.com/license/new-bsd New BSD License
 */
namespace CallLog\Mapper\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Stdlib\Hydrator\Aggregate\AggregateHydrator;
use CallLog\Mapper\LogMapper;
use CallLog\Hydrator\LogHydrator;
use CallLog\Entity\LogEntity;

class LogMapperFactory
{
    /**
     * 
     * @param ServiceLocatorInterface $serviceLocator
     * @return \CallLog\Mapper\LogMapper
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        
        $hydrator = new AggregateHydrator();
        
        $hydrator->add(new LogHydrator());
        
        $prototype = new LogEntity();
        
        $readAdapter = $serviceLocator->get('db1');
        
        $writeAdapter = $serviceLocator->get('db2');
        
        return new LogMapper($readAdapter, $writeAdapter, $hydrator, $prototype);
    }
}