<?php
/**
 * Pacific NM (https://www.pacificnm.com)
 *
 * @link      https://github.com/pacificnm/pnm for the canonical source repository
 * @copyright Copyright (c) 20011-2016 Pacific NM USA Inc. (https://www.pacificnm.com)
 * @license
 */
namespace Config\Service\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use Config\Service\ConfigService;

/**
 *
 * @author jaimie <pacificnm@gmail.com>
 * @version 2.5.0
 *         
 */
class ConfigServiceFactory
{

    /**
     *
     * @param ServiceLocatorInterface $serviceLocator            
     * @return \Config\Service\ConfigService
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        $mapper = $serviceLocator->get('Config\Mapper\ConfigMapperInterface');
        
        $memcached = $serviceLocator->get('memcached');
        
        return new ConfigService($mapper, $memcached);
    }
}