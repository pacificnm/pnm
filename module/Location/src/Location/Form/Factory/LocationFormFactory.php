<?php
/**
 * Pacific NM (https://www.pacificnm.com)
 *
 * @link      https://github.com/pacificnm/pnm for the canonical source repository
 * @copyright Copyright (c) 20011-2016 Pacific NM USA Inc. (https://www.pacificnm.com)
 * @license   https://www.pacificnm.com/license/new-bsd New BSD License
 */
namespace Location\Form\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use Location\Form\LocationForm;

/**
 *
 * @author jaimie <pacificnm@gmail.com>
 * @version 2.5.0
 *
 */
class LocationFormFactory
{
    /**
     * 
     * @param ServiceLocatorInterface $serviceLocator
     * @return \Location\Form\LocationForm
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        $locationService = $serviceLocator->get('Location\Service\LocationServiceInterface');
        
        return new LocationForm($locationService);
    }

}