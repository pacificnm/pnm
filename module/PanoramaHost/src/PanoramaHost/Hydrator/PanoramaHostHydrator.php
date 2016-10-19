<?php
namespace PanoramaHost\Hydrator;

use PanoramaHost\Entity\PanoramaHostEntity;
use Zend\Stdlib\Hydrator\ClassMethods;

class PanoramaHostHydrator extends ClassMethods
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
        if (! $object instanceof PanoramaHostEntity) {
            return $object;
        }
        
        parent::hydrate($data, $object);
        
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
        if (! $object instanceof PanoramaHostEntity) {
            return $object;
        }
        
        $data = parent::extract($object);
        
        unset($data['host_entity']);
        
        return $data;
    }
}

?>