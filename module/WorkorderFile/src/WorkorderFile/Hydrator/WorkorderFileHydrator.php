<?php
namespace WorkorderFile\Hydrator;

use Zend\Stdlib\Hydrator\ClassMethods;
use WorkorderFile\Entity\WorkorderFileEntity;
use File\Entity\FileEntity;

class WorkorderFileHydrator extends ClassMethods
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
     * {@inheritdoc}
     *
     * @see \Zend\Stdlib\Hydrator\ClassMethods::hydrate()
     */
    public function hydrate(array $data, $object)
    {
        if (! $object instanceof WorkorderFileEntity) {
            return $object;
        }
        
        parent::hydrate($data, $object);
        
        $fileEntity = parent::hydrate($data, new FileEntity());
        
        $object->setFileEntity($fileEntity);
        
        return $object;
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \Zend\Stdlib\Hydrator\ClassMethods::extract()
     */
    public function extract($object)
    {
        if (! $object instanceof WorkorderFileEntity) {
            return $object;
        }
        
        $data = parent::extract($object);
        
        unset($data['file_entity']);
        
        return $data;
    }
}

