<?php
/**
 * Pacific NM (https://www.pacificnm.com)
 *
 * @link      https://github.com/pacificnm/pnm for the canonical source repository
 * @copyright Copyright (c) 20011-2016 Pacific NM USA Inc. (https://www.pacificnm.com)
 * @license
 */
namespace Config\View\Helper\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use Config\View\Helper\AppConfig;

/**
 *
 * @author jaimie <pacificnm@gmail.com>
 * @version 2.5.0
 *
 */
class AppConfigFactory
{
    /**
     * 
     * @param ServiceLocatorInterface $serviceLocator
     * @return \Config\View\Helper\AppConfig
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        $realServiceLocator = $serviceLocator->getServiceLocator();
        
        $configService = $realServiceLocator->get('Config\Service\ConfigServiceInterface');
        
        return new AppConfig($configService);
    }

}
