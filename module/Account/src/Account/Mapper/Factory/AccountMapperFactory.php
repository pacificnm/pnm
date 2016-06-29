<?php
/**
 * Pacific NM (https://www.pacificnm.com)
 *
 * @link      https://github.com/pacificnm/pnm for the canonical source repository
 * @copyright Copyright (c) 20011-2016 Pacific NM USA Inc. (https://www.pacificnm.com)
 * @license   https://www.pacificnm.com/license/new-bsd New BSD License
 */
namespace Account\Mapper\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Stdlib\Hydrator\Aggregate\AggregateHydrator;
use Account\Mapper\AccountMapper;
use Account\Hydrator\AccountHydrator;
use Account\Entity\AccountEntity;

/**
 *
 * @author jaimie
 *
 */
class AccountMapperFactory
{

    /**
     * 
     * @param ServiceLocatorInterface $serviceLocator
     * @return \Account\Mapper\AccountMapper
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        $hydrator = new AggregateHydrator();
        
        $hydrator->add(new AccountHydrator());
        
        $prototype = new AccountEntity();
        
        $readAdapter = $serviceLocator->get('db1');
        
        $writeAdapter = $serviceLocator->get('db2');
        
        return new AccountMapper($readAdapter, $writeAdapter, $hydrator, $prototype);
    }
}