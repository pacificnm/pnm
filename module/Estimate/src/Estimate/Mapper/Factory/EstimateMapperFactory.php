<?php
/**
 * Pacific NM (https://www.pacificnm.com)
 *
 * @link      https://github.com/pacificnm/pnm for the canonical source repository
 * @copyright Copyright (c) 20011-2016 Pacific NM USA Inc. (https://www.pacificnm.com)
 * @license   https://www.pacificnm.com/license/new-bsd New BSD License
 */
namespace Estimate\Mapper\Factory;

use Estimate\Mapper\EstimateMapper;
use Zend\Stdlib\Hydrator\Aggregate\AggregateHydrator;
use Zend\ServiceManager\ServiceLocatorInterface;
use Estimate\Hydrator\EstimateHydrator;
use Estimate\Entity\EstimateEntity;

class EstimateMapperFactory
{
    /**
     * 
     * @param ServiceLocatorInterface $serviceLocator
     * @return \Estimate\Mapper\EstimateMapper
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        $hydrator = new AggregateHydrator();
        
        $hydrator->add(new EstimateHydrator());
        
        $prototype = new EstimateEntity();
        
        $readAdapter = $serviceLocator->get('db1');
        
        $writeAdapter = $serviceLocator->get('db2');
        
        return new EstimateMapper($readAdapter, $writeAdapter, $hydrator, $prototype);
    }
}