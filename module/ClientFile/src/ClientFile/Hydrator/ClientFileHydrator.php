<?php
namespace ClientFile\Hydrator;

use Zend\Stdlib\Hydrator\ClassMethods;
use ClientFile\Entity\ClientFileEntity;
use File\Entity\FileEntity;
use Auth\Entity\AuthEntity;

class ClientFileHydrator extends ClassMethods
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
        if (! $object instanceof ClientFileEntity) {
            return $object;
        }
        
        parent::hydrate($data, $object);
        
        $fileEntity = parent::hydrate($data, new FileEntity());
        
        $object->setFileEntity($fileEntity);
        
        $authEntity = parent::hydrate($data, new AuthEntity());
        
        $object->setAuthEntity($authEntity);
        
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
        if (! $object instanceof ClientFileEntity) {
            return $object;
        }
        
        $data = parent::extract($object);
        
        unset($data['file_entity']);
        
        unset($data['auth_entity']);
        
        return $data;
    }
}