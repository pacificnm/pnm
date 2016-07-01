<?php
/**
 * Pacific NM (https://www.pacificnm.com)
 *
 * @link      https://github.com/pacificnm/pnm for the canonical source repository
 * @copyright Copyright (c) 20011-2016 Pacific NM USA Inc. (https://www.pacificnm.com)
 * @license   https://www.pacificnm.com/license/new-bsd New BSD License
 */
namespace Employee\V1\Rest\EmployeeTime;

use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * 
 * @author jaimie <pacificnm@gmail.com>
 * @version 2.5.0
 *
 */
class EmployeeTimeResourceFactory
{
    /**
     * 
     * @param ServiceLocatorInterface $serviceLocator
     * @return \Employee\V1\Rest\EmployeeTime\EmployeeTimeResource
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        $timeService = $serviceLocator->get('WorkorderTime\Service\TimeServiceInterface');
        
        return new EmployeeTimeResource($timeService);
    }
}
