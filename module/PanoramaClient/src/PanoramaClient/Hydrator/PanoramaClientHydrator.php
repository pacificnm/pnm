<?php
namespace PanoramaClient\Hydrator;

use Zend\Stdlib\Hydrator\ClassMethods;
use PanoramaClient\Entity\PanoramaClientEntity;
use Client\Entity\ClientEntity;

class PanoramaClientHydrator extends ClassMethods
{

    /**
     *
     * @param string $underscoreSeparatedKeys            
     */
    public function __construct($underscoreSeparatedKeys = true)
    {
        parent::__construct($underscoreSeparatedKeys);
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \Zend\Stdlib\Hydrator\ClassMethods::hydrate()
     */
    public function hydrate(array $data, $object)
    {
        if (! $object instanceof PanoramaClientEntity) {
            return $object;
        }
        
        parent::hydrate($data, $object);
        
        $clientEntity = parent::hydrate($data, new ClientEntity());
        
        $object->setClientEntity($clientEntity);
        
        return $object;
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \Zend\Stdlib\Hydrator\ClassMethods::extract()
     */
    public function extract($object)
    {
        if (! $object instanceof PanoramaClientEntity) {
            return $object;
        }
        
        $data = parent::extract($object);
        
        unset($data['client_entity']);
        
        return $data;
    }
}