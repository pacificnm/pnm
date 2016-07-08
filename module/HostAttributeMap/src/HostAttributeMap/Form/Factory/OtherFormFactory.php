<?php
namespace HostAttributeMap\Form\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use HostAttributeMap\Form\OtherForm;

class OtherFormFactory
{

    /**
     *
     * @param ServiceLocatorInterface $serviceLocator            
     * @return \HostAttributeMap\Form\OtherForm
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        $valueService = $serviceLocator->get('HostAttributeValue\Service\ValueServiceInterface');
        
        return new OtherForm($valueService);
    }
}