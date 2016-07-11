<?php
/**
 * Pacific NM (https://www.pacificnm.com)
 *
 * @link      https://github.com/pacificnm/pnm for the canonical source repository
 * @copyright Copyright (c) 20011-2016 Pacific NM USA Inc. (https://www.pacificnm.com)
 * @license   https://www.pacificnm.com/license/new-bsd New BSD License
 */
namespace EstimateOptionItem\Mapper\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Stdlib\Hydrator\Aggregate\AggregateHydrator;
use EstimateOptionItem\Mapper\ItemMapper;
use EstimateOptionItem\Hydrator\ItemHydrator;
use EstimateOptionItem\Entity\ItemEntity;
class ItemMapperFactory
{
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        $hydrator = new AggregateHydrator();
        
        $hydrator->add(new ItemHydrator());
        
        $prototype = new ItemEntity();
        
        $readAdapter = $serviceLocator->get('db1');
        
        $writeAdapter = $serviceLocator->get('db2');
        
        
        return new ItemMapper($readAdapter, $writeAdapter, $hydrator, $prototype);
    }
}