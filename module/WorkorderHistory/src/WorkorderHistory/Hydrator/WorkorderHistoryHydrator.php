<?php
namespace WorkorderHistory\Hydrator;

use Zend\Stdlib\Hydrator\ClassMethods;
use WorkorderHistory\Entity\WorkorderHistoryEntity;
use History\Entity\HistoryEntity;
use Auth\Entity\AuthEntity;

class WorkorderHistoryHydrator extends ClassMethods
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
        if (! $object instanceof WorkorderHistoryEntity) {
            return $object;
        }
    
        parent::hydrate($data, $object);
    
        $historyEntity = parent::hydrate($data, new HistoryEntity());
        
        $object->setHistoryEntity($historyEntity);
        
        if($historyEntity) {
            $authEntity = parent::hydrate($data, new AuthEntity());
            
            $object->getHistoryEntity()->setAuthEntity($authEntity);
        }
        
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
        if (! $object instanceof WorkorderHistoryEntity) {
            return $object;
        }
    
        $data = parent::extract($object);
    
        unset($data['history_entity']);
        
        return $data;
    }
}

