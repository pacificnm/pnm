<?php
/**
 * Pacific NM (https://www.pacificnm.com)
 *
 * @link      https://github.com/pacificnm/pnm for the canonical source repository
 * @copyright Copyright (c) 20011-2016 Pacific NM USA Inc. (https://www.pacificnm.com)
 * @license   https://www.pacificnm.com/license/new-bsd New BSD License
 */
namespace Employee\Controller\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use Employee\Controller\TimePrintController;

/**
 *
 * @author jaimie <pacificnm@gmail.com>
 * @version 2.5.0
 *         
 */
class TimePrintControllerFactory
{

    /**
     *
     * @param ServiceLocatorInterface $serviceLocator            
     * @return \Employee\Controller\TimePrintController
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        $realServiceLocator = $serviceLocator->getServiceLocator();
        
        $timeService = $realServiceLocator->get('WorkorderTime\Service\TimeServiceInterface');
        
        return new TimePrintController($timeService);
    }
}