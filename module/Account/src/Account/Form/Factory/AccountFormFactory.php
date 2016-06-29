<?php
/**
 * Pacific NM (https://www.pacificnm.com)
 *
 * @link      https://github.com/pacificnm/pnm for the canonical source repository
 * @copyright Copyright (c) 20011-2016 Pacific NM USA Inc. (https://www.pacificnm.com)
 * @license   https://www.pacificnm.com/license/new-bsd New BSD License
 */
namespace Account\Form\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use Account\Form\AccountForm;

/**
 *
 * @author jaimie <pacificnm@gmail.com>
 * @version 2.5.0
 *
 */
class AccountFormFactory
{
    /**
     * 
     * @param ServiceLocatorInterface $serviceLocator
     * @return \Account\Form\AccountForm
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        $typeService = $serviceLocator->get('AccountType\Service\TypeServiceInterface');
        
        return new AccountForm($typeService);
    }

}