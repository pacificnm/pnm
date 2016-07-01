<?php
/**
 * Pacific NM (https://www.pacificnm.com)
 *
 * @link      https://github.com/pacificnm/pnm for the canonical source repository
 * @copyright Copyright (c) 20011-2016 Pacific NM USA Inc. (https://www.pacificnm.com)
 * @license   https://www.pacificnm.com/license/new-bsd New BSD License
 */
namespace Workorder\V1\Rest\Schedule;

use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * 
 * @author jaimie <pacificnm@gmail.com>
 * @version 2.5.0
 *
 */
class ScheduleResourceFactory
{

    /**
     * 
     * @param ServiceLocatorInterface $serviceLocator
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        $workorderService = $serviceLocator->get('Workorder\Service\WorkorderServiceInterface');
        
        return new ScheduleResource($workorderService);
    }
}
