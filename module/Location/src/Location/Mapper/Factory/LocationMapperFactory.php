<?php
/**
 * Pacific NM (https://www.pacificnm.com)
 *
 * @link      https://github.com/pacificnm/pnm for the canonical source repository
 * @copyright Copyright (c) 20011-2016 Pacific NM USA Inc. (https://www.pacificnm.com)
 * @license   https://www.pacificnm.com/license/new-bsd New BSD License
 */
namespace Location\Mapper\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Stdlib\Hydrator\Aggregate\AggregateHydrator;
use Location\Mapper\LocationMapper;
use Location\Hydrator\LocationHydrator;
use Location\Entity\LocationEntity;

/**
 *
 * @author jaimie <pacificnm@gmail.com>
 * @version 2.5.0
 *
 */
class LocationMapperFactory
{
    /**
     * 
     * @param ServiceLocatorInterface $serviceLocator
     * @return \Location\Mapper\LocationMapper
     */
   public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        $hydrator = new AggregateHydrator();
        
        $hydrator->add(new LocationHydrator());
        
        $prototype = new LocationEntity();
        
        $readAdapter = $serviceLocator->get('db1');
        
        $writeAdapter = $serviceLocator->get('db2');
        
        return new LocationMapper($readAdapter, $writeAdapter, $hydrator, $prototype);
    }
}