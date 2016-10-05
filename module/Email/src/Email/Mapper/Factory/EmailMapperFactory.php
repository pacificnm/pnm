<?php
/**
 * Pacific NM (https://www.pacificnm.com)
 *
 * @link      https://github.com/pacificnm/pnm for the canonical source repository
 * @copyright Copyright (c) 20011-2016 Pacific NM USA Inc. (https://www.pacificnm.com)
 * @license
 */
namespace Email\Mapper\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Stdlib\Hydrator\Aggregate\AggregateHydrator;
use Email\Mapper\EmailMapper;
use Email\Hydrator\EmailHydrator;
use Email\Entity\EmailEntity;

class EmailMapperFactory
{

    /**
     *
     * @param ServiceLocatorInterface $serviceLocator            
     * @return \Email\Mapper\EmailMapper
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        $hydrator = new AggregateHydrator();
        
        $hydrator->add(new EmailHydrator());
        
        $prototype = new EmailEntity();
        
        $readAdapter = $serviceLocator->get('db1');
        
        $writeAdapter = $serviceLocator->get('db2');
        
        return new EmailMapper($readAdapter, $writeAdapter, $hydrator, $prototype);
    }
}